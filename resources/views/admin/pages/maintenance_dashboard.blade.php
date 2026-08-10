@extends('layouts.admin')
@section('content')
    <div class="admin-card" style="border-left:5px solid {{ $maintenanceMode ? '#E53935' : '#2E7D32' }}">
        <div class="card-header">
            <h3><i class="fas fa-tools"></i> মেইনটেন্যান্স কন্ট্রোল সেন্টার</h3>
            <span class="badge {{ $maintenanceMode ? 'badge-danger' : 'badge-success' }}"
                style="font-size:13px;padding:5px 14px">
                {{ $maintenanceMode ? '⚠️ মেইনটেন্যান্স মোড চালু' : '✅ সাইট সক্রিয়' }}
            </span>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start">
                <div>
                    <form action="{{ route('admin.maintenance.toggle') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>মেইনটেন্যান্স বার্তা</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="দর্শকদের জন্য বার্তা লিখুন...">{{ $settings['maintenance_message'] ?? 'সাইটটি সাময়িকভাবে রক্ষণাবেক্ষণের জন্য বন্ধ আছে। শীঘ্রই ফিরে আসছি।' }}</textarea>
                        </div>
                        <button type="submit" class="btn {{ $maintenanceMode ? 'btn-success' : 'btn-danger' }}"
                            style="width:100%;justify-content:center;padding:10px">
                            @if ($maintenanceMode)
                                <i class="fas fa-power-off"></i> মেইনটেন্যান্স মোড বন্ধ করুন (সাইট চালু করুন)
                            @else
                                <i class="fas fa-tools"></i> মেইনটেন্যান্স মোড চালু করুন (সাইট বন্ধ রাখুন)
                            @endif
                        </button>
                    </form>
                    <div
                        style="margin-top:12px;padding:10px;background:#fff3e0;border:1px solid #ffe0b2;border-radius:4px;font-size:12px;color:#e65100">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>সতর্কতা:</strong> মেইনটেন্যান্স মোড চালু থাকলে শুধুমাত্র অ্যাডমিন সাইট দেখতে পাবেন।
                    </div>
                </div>
                <div>
                    <div style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:6px;padding:16px">
                        <h4 style="font-size:13px;font-weight:700;margin-bottom:12px;color:#1565C0">⚡ দ্রুত অ্যাকশন</h4>
                        <form action="{{ route('admin.maintenance.cache-clear') }}" method="POST"
                            style="margin-bottom:8px">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
                                <i class="fas fa-broom"></i> ক্যাশ পরিষ্কার করুন
                            </button>
                        </form>
                        <a href="{{ route('admin.backup.create') }}"
                            onclick="this.closest('div').querySelector('form[action*=backup]').submit();return false">
                        </a>
                        <form action="{{ route('admin.backup.create') }}" method="POST" style="margin-bottom:8px">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" style="width:100%;justify-content:center">
                                <i class="fas fa-database"></i> এখনই ব্যাকআপ নিন
                            </button>
                        </form>
                        <a href="{{ route('admin.system-info') }}" class="btn btn-sm"
                            style="width:100%;justify-content:center;background:#f5f7fa;border:1px solid #dde1e9;display:flex;align-items:center;gap:6px">
                            <i class="fas fa-server"></i> সিস্টেম তথ্য দেখুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px">

        <div class="admin-card" style="margin-bottom:0">
            <div class="card-body" style="text-align:center;padding:16px">
                <div style="font-size:28px;margin-bottom:6px">💾</div>
                <div style="font-size:20px;font-weight:700;color:#1565C0">{{ $diskUsage['used'] }}</div>
                <div style="font-size:11px;color:#888;margin-bottom:8px">ডিস্ক ব্যবহার / {{ $diskUsage['total'] }}</div>
                <div style="height:6px;background:#eee;border-radius:3px;overflow:hidden">
                    <div
                        style="height:100%;width:{{ $diskUsage['percent'] }}%;background:{{ $diskUsage['percent'] > 80 ? '#E53935' : ($diskUsage['percent'] > 60 ? '#F57F17' : '#2E7D32') }};border-radius:3px">
                    </div>
                </div>
                <div style="font-size:11px;color:#888;margin-top:3px">{{ $diskUsage['percent'] }}% ব্যবহৃত</div>
            </div>
        </div>

        <div class="admin-card" style="margin-bottom:0">
            <div class="card-body" style="text-align:center;padding:16px">
                <div style="font-size:28px;margin-bottom:6px">🗄️</div>
                <div style="font-size:20px;font-weight:700;color:#2E7D32">{{ $dbSize['size'] }}</div>
                <div style="font-size:11px;color:#888">ডেটাবেস সাইজ</div>
                <div style="font-size:11px;color:#1565C0;margin-top:6px">{{ config('database.default', 'mysql') }}</div>
            </div>
        </div>

        <div class="admin-card" style="margin-bottom:0">
            <div class="card-body" style="text-align:center;padding:16px">
                <div style="font-size:28px;margin-bottom:6px">🐘</div>
                <div style="font-size:20px;font-weight:700;color:#7B1FA2">PHP {{ $systemInfo['php_version'] }}</div>
                <div style="font-size:11px;color:#888">PHP ভার্সন</div>
                <div style="font-size:11px;color:#1565C0;margin-top:6px">Laravel {{ $systemInfo['laravel_ver'] }}</div>
            </div>
        </div>

        <div class="admin-card" style="margin-bottom:0">
            <div class="card-body" style="text-align:center;padding:16px">
                <div style="font-size:28px;margin-bottom:6px">📋</div>
                <div style="font-size:20px;font-weight:700;color:#F57F17">{{ $recentLogs->count() }}</div>
                <div style="font-size:11px;color:#888">সাম্প্রতিক অ্যাক্টিভিটি</div>
                <a href="{{ route('admin.activity-logs') }}"
                    style="font-size:11px;color:#1565C0;margin-top:6px;display:block">সব দেখুন →</a>
            </div>
        </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-list-alt"></i> সাম্প্রতিক অ্যাক্টিভিটি</h3>
                <a href="{{ route('admin.activity-logs') }}" class="btn btn-sm btn-primary">সব দেখুন</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ব্যবহারকারী</th>
                            <th>অ্যাকশন</th>
                            <th>সময়</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLogs as $log)
                            <tr>
                                <td style="font-size:12px">{{ $log->user_name ?? 'System' }}</td>
                                <td>
                                    @php
                                        $icons = [
                                            'login' => '🔑',
                                            'logout' => '🚪',
                                            'maintenance_on' => '⚠️',
                                            'maintenance_off' => '✅',
                                            'backup_created' => '💾',
                                            'cache_cleared' => '🧹',
                                            'announcement_created' => '📢',
                                            'site_controls_updated' => '⚙️',
                                        ];
                                        $icon = $icons[$log->action] ?? '📝';
                                    @endphp
                                    <span style="font-size:12px">{{ $icon }} {{ $log->description }}</span>
                                </td>
                                <td style="font-size:11px;color:#888;white-space:nowrap">
                                    {{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;color:#999;padding:20px">কোনো অ্যাক্টিভিটি নেই
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-bullhorn"></i> সক্রিয় ঘোষণাসমূহ</h3>
                <a href="{{ route('admin.announcements.create') }}" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> নতুন</a>
            </div>
            <div style="padding:14px">
                @forelse($announcements as $ann)
                    @php
                        $colors = [
                            'info' => ['#E3F2FD', '#1565C0'],
                            'success' => ['#E8F5E9', '#2E7D32'],
                            'warning' => ['#FFF8E1', '#F57F17'],
                            'danger' => ['#FFEBEE', '#C62828'],
                        ];
                        $c = $colors[$ann->type] ?? $colors['info'];
                    @endphp
                    <div
                        style="background:{{ $c[0] }};border-left:4px solid {{ $c[1] }};padding:10px 12px;border-radius:0 4px 4px 0;margin-bottom:8px">
                        <div style="font-weight:700;font-size:13px;color:{{ $c[1] }};margin-bottom:3px">
                            {{ $ann->title }}</div>
                        <div style="font-size:12px;color:#555">{{ \Illuminate\Support\Str::limit($ann->message, 80) }}
                        </div>
                        <div style="display:flex;gap:8px;margin-top:6px;align-items:center">
                            @if ($ann->show_popup)
                                <span
                                    style="font-size:10px;background:{{ $c[1] }};color:#fff;padding:1px 6px;border-radius:8px">Popup</span>
                            @endif
                            @if ($ann->show_banner)
                                <span
                                    style="font-size:10px;background:{{ $c[1] }};color:#fff;padding:1px 6px;border-radius:8px">Banner</span>
                            @endif
                            <a href="{{ route('admin.announcements.edit', $ann) }}"
                                style="margin-left:auto;font-size:11px;color:{{ $c[1] }}">সম্পাদনা</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state"><i class="fas fa-bullhorn"></i>
                        <p>কোনো ঘোষণা নেই</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
