<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\SiteControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function index()
    {
        $systemInfo  = $this->getSystemInfo();
        $diskUsage   = $this->getDiskUsage();
        $dbSize      = $this->getDbSize();
        $recentLogs  = ActivityLog::latest()->take(20)->get();
        $announcements = Announcement::latest()->take(5)->get();
        $maintenanceMode = Setting::where('key', 'maintenance_mode')->value('value') === '1';

        return view('admin.pages.maintenance_dashboard', compact(
            'systemInfo',
            'diskUsage',
            'dbSize',
            'recentLogs',
            'announcements',
            'maintenanceMode'
        ));
    }

    public function toggleMaintenance(Request $request)
    {
        $current = Setting::where('key', 'maintenance_mode')->value('value') === '1';
        $new     = !$current;

        Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => $new ? '1' : '0']);
        Setting::updateOrCreate(
            ['key' => 'maintenance_message'],
            ['value' => $request->input('message', 'সাইটটি সাময়িকভাবে রক্ষণাবেক্ষণের জন্য বন্ধ আছে। শীঘ্রই ফিরে আসছি।')]
        );

        ActivityLog::create([
            'user_id'    => auth()->id(),
            'user_name'  => auth()->user()->name,
            'action'     => $new ? 'maintenance_on' : 'maintenance_off',
            'description' => $new ? 'মেইনটেন্যান্স মোড চালু করা হয়েছে' : 'মেইনটেন্যান্স মোড বন্ধ করা হয়েছে',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', $new
            ? 'মেইনটেন্যান্স মোড চালু হয়েছে। ওয়েবসাইট দর্শকদের জন্য বন্ধ আছে।'
            : 'মেইনটেন্যান্স মোড বন্ধ হয়েছে। ওয়েবসাইট এখন সক্রিয়।');
    }

    public function announcements()
    {
        $announcements = Announcement::latest()->paginate(15);
        return view('admin.pages.announcements_index', compact('announcements'));
    }

    public function announcementCreate()
    {
        return view('admin.pages.announcements_form');
    }

    public function announcementStore(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:200',
            'message'    => 'required|string',
            'type'       => 'required|in:info,success,warning,danger',
            'show_popup' => 'nullable|boolean',
            'show_banner' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date',
        ]);

        Announcement::create([
            'title'       => $request->title,
            'message'     => $request->message,
            'type'        => $request->type,
            'show_popup'  => $request->boolean('show_popup'),
            'show_banner' => $request->boolean('show_banner'),
            'is_active'   => $request->boolean('is_active', true),
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ]);

        $this->logActivity('announcement_created', 'নতুন ঘোষণা তৈরি: ' . $request->title, $request);
        return redirect()->route('admin.announcements.index')->with('success', 'ঘোষণা যোগ হয়েছে।');
    }

    public function announcementEdit(Announcement $announcement)
    {
        return view('admin.pages.announcements_form', compact('announcement'));
    }

    public function announcementUpdate(Request $request, Announcement $announcement)
    {
        $announcement->update([
            'title'       => $request->title,
            'message'     => $request->message,
            'type'        => $request->type,
            'show_popup'  => $request->boolean('show_popup'),
            'show_banner' => $request->boolean('show_banner'),
            'is_active'   => $request->boolean('is_active', true),
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ]);
        return redirect()->route('admin.announcements.index')->with('success', 'ঘোষণা আপডেট হয়েছে।');
    }

    public function announcementDestroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'ঘোষণা মুছে ফেলা হয়েছে।');
    }

    // ══════════════════════════════════════
    // ACTIVITY LOGS
    // ══════════════════════════════════════
    public function activityLogs(Request $request)
    {
        $query = ActivityLog::query();
        if ($request->filled('user'))   $query->where('user_name', 'like', '%' . $request->user . '%');
        if ($request->filled('action')) $query->where('action', $request->action);
        if ($request->filled('date'))   $query->whereDate('created_at', $request->date);
        $logs    = $query->latest()->paginate(30);
        $actions = ActivityLog::distinct()->pluck('action')->sort();
        return view('admin.pages.activity_logs', compact('logs', 'actions'));
    }

    public function clearLogs(Request $request)
    {
        $days = (int)($request->days ?? 30);
        ActivityLog::where('created_at', '<', now()->subDays($days))->delete();
        return back()->with('success', $days . ' দিনের পুরোনো লগ মুছে ফেলা হয়েছে।');
    }

    // ══════════════════════════════════════
    // SITE CONTROLS
    // ══════════════════════════════════════
    public function siteControls()
    {
        $controls = [
            'allow_admission'   => Setting::where('key', 'allow_admission')->value('value')   ?? '1',
            'allow_result_view' => Setting::where('key', 'allow_result_view')->value('value') ?? '1',
            'show_gallery'      => Setting::where('key', 'show_gallery')->value('value')      ?? '1',
            'show_ticker'       => Setting::where('key', 'show_ticker')->value('value')       ?? '1',
            'show_notice'       => Setting::where('key', 'show_notice')->value('value')       ?? '1',
            'show_download'     => Setting::where('key', 'show_download')->value('value')     ?? '1',
            'registration_open' => Setting::where('key', 'registration_open')->value('value') ?? '1',
            'contact_email'     => Setting::where('key', 'contact_email')->value('value')     ?? '',
            'sms_notification'  => Setting::where('key', 'sms_notification')->value('value')  ?? '0',
            'academic_year'     => Setting::where('key', 'academic_year')->value('value')     ?? date('Y'),
            'footer_note'       => Setting::where('key', 'footer_note')->value('value')       ?? '',
            'google_analytics'  => Setting::where('key', 'google_analytics')->value('value')  ?? '',
            'custom_css'        => Setting::where('key', 'custom_css')->value('value')        ?? '',
            'custom_js'         => Setting::where('key', 'custom_js')->value('value')         ?? '',
        ];
        return view('admin.pages.site_controls', compact('controls'));
    }

    public function updateSiteControls(Request $request)
    {
        $fields = [
            'allow_admission',
            'allow_result_view',
            'show_gallery',
            'show_ticker',
            'show_notice',
            'show_download',
            'registration_open',
            'sms_notification',
        ];

        foreach ($fields as $f) {
            Setting::updateOrCreate(['key' => $f], ['value' => $request->has($f) ? '1' : '0']);
        }

        $textFields = ['contact_email', 'academic_year', 'footer_note', 'google_analytics', 'custom_css', 'custom_js'];
        foreach ($textFields as $f) {
            Setting::updateOrCreate(['key' => $f], ['value' => $request->input($f, '')]);
        }

        $this->logActivity('site_controls_updated', 'সাইট কন্ট্রোল আপডেট করা হয়েছে', $request);
        return back()->with('success', 'সাইট কন্ট্রোল সংরক্ষণ হয়েছে।');
    }

    // ══════════════════════════════════════
    // BACKUP
    // ══════════════════════════════════════
    public function backup()
    {
        $backups = collect();
        try {
            $files = Storage::disk('local')->files('backups');
            $backups = collect($files)->map(function ($f) {
                return [
                    'name' => basename($f),
                    'path' => $f,
                    'size' => $this->formatBytes(Storage::disk('local')->size($f)),
                    'date' => date('d/m/Y H:i', Storage::disk('local')->lastModified($f)),
                ];
            })->sortByDesc('date');
        } catch (\Exception $e) {
        }

        return view('admin.pages.backup', compact('backups'));
    }

    public function createBackup(Request $request)
    {
        try {
            // Create backup directory
            Storage::disk('local')->makeDirectory('backups');

            $timestamp = now()->format('Y-m-d_H-i-s');
            $filename  = "backup_{$timestamp}.sql";
            $path      = storage_path("app/backups/{$filename}");

            // Get DB credentials
            $db   = config('database.connections.mysql.database');
            $user = config('database.connections.mysql.username');
            $pass = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');

            if ($db && $user) {
                $cmd = "mysqldump --host={$host} --user={$user} --password={$pass} {$db} > {$path} 2>&1";
                exec($cmd, $output, $return);

                if ($return === 0 && file_exists($path) && filesize($path) > 100) {
                    $this->logActivity('backup_created', "ব্যাকআপ তৈরি: {$filename}", $request);
                    return back()->with('success', "✅ ব্যাকআপ সফলভাবে তৈরি হয়েছে: {$filename}");
                }
            }

            // Fallback: create JSON backup of key data
            $data = [
                'timestamp' => now()->toISOString(),
                'settings'  => DB::table('settings')->get(),
                'notices'   => DB::table('notices')->get(),
                'downloads' => DB::table('downloads')->get(),
                'teachers'  => DB::table('teachers')->get(),
            ];
            $jsonFile = "backup_{$timestamp}.json";
            Storage::disk('local')->put("backups/{$jsonFile}", json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->logActivity('backup_created', "JSON ব্যাকআপ তৈরি: {$jsonFile}", $request);
            return back()->with('success', "✅ ডেটা ব্যাকআপ তৈরি হয়েছে: {$jsonFile}");
        } catch (\Exception $e) {
            return back()->with('error', 'ব্যাকআপ তৈরিতে সমস্যা হয়েছে: ' . $e->getMessage());
        }
    }

    public function downloadBackup($filename)
    {
        $path = "backups/{$filename}";
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->download($path);
        }
        return back()->with('error', 'ফাইলটি পাওয়া যায়নি।');
    }

    public function deleteBackup($filename)
    {
        Storage::disk('local')->delete("backups/{$filename}");
        return back()->with('success', 'ব্যাকআপ মুছে ফেলা হয়েছে।');
    }

    // ══════════════════════════════════════
    // CACHE MANAGEMENT
    // ══════════════════════════════════════
    public function clearCache(Request $request)
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            $this->logActivity('cache_cleared', 'ক্যাশ পরিষ্কার করা হয়েছে', $request);
            return back()->with('success', '✅ সব ক্যাশ সফলভাবে পরিষ্কার হয়েছে।');
        } catch (\Exception $e) {
            return back()->with('error', 'ক্যাশ পরিষ্কারে সমস্যা: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════
    // SYSTEM INFO
    // ══════════════════════════════════════
    public function systemInfo()
    {
        $info = $this->getSystemInfo();
        $info['disk']   = $this->getDiskUsage();
        $info['db']     = $this->getDbSize();
        $info['tables'] = $this->getTableSizes();
        return view('admin.pages.system_info', compact('info'));
    }

    // ══════════════════════════════════════
    // PRIVATE HELPERS
    // ══════════════════════════════════════
    private function getSystemInfo(): array
    {
        return [
            'php_version'   => PHP_VERSION,
            'laravel_ver'   => app()->version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
            'memory_limit'  => ini_get('memory_limit'),
            'max_upload'    => ini_get('upload_max_filesize'),
            'max_post'      => ini_get('post_max_size'),
            'timezone'      => config('app.timezone'),
            'locale'        => config('app.locale'),
            'env'           => config('app.env'),
            'debug'         => config('app.debug') ? 'চালু' : 'বন্ধ',
            'db_connection' => config('database.default'),
            'cache_driver'  => config('cache.default'),
            'session_driver' => config('session.driver'),
            'uptime'        => $this->getUptime(),
        ];
    }

    private function getDiskUsage(): array
    {
        $total = @disk_total_space('/') ?: 0;
        $free  = @disk_free_space('/')  ?: 0;
        $used  = $total - $free;
        return [
            'total'   => $this->formatBytes($total),
            'used'    => $this->formatBytes($used),
            'free'    => $this->formatBytes($free),
            'percent' => $total > 0 ? round(($used / $total) * 100, 1) : 0,
        ];
    }

    private function getDbSize(): array
    {
        try {
            $db   = config('database.connections.mysql.database');
            $size = DB::select("SELECT SUM(data_length + index_length) as size FROM information_schema.TABLES WHERE table_schema = ?", [$db]);
            return ['size' => $this->formatBytes($size[0]->size ?? 0), 'raw' => $size[0]->size ?? 0];
        } catch (\Exception $e) {
            return ['size' => 'N/A', 'raw' => 0];
        }
    }

    private function getTableSizes(): array
    {
        try {
            $db     = config('database.connections.mysql.database');
            return DB::select("SELECT table_name, ROUND((data_length+index_length)/1024,1) as size_kb, table_rows FROM information_schema.TABLES WHERE table_schema = ? ORDER BY (data_length+index_length) DESC", [$db]);
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getUptime(): string
    {
        if (file_exists('/proc/uptime')) {
            $up  = (int) file_get_contents('/proc/uptime');
            $d   = floor($up / 86400);
            $h   = floor(($up % 86400) / 3600);
            $m   = floor(($up % 3600) / 60);
            return "{$d}d {$h}h {$m}m";
        }
        return 'N/A';
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow   = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        $pow   = min($pow, count($units) - 1);
        return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
    }

    private function logActivity(string $action, string $description, Request $request = null): void
    {
        try {
            ActivityLog::create([
                'user_id'     => auth()->id(),
                'user_name'   => auth()->user()->name ?? 'System',
                'action'      => $action,
                'description' => $description,
                'ip_address'  => $request?->ip() ?? request()->ip(),
            ]);
        } catch (\Exception $e) {
        }
    }
}
