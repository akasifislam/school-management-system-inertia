<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Principal;
use App\Models\Setting;
use App\Models\Announcement;
use App\Models\ActivityLog;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share data globally with all views
        View::composer('*', function ($view) {
            static $shared = null;
            if ($shared === null) {
                try {
                    $shared = [
                        'principal'     => Principal::first(),
                        'settings'      => Setting::pluck('value', 'key')->toArray(),
                        'announcements' => Announcement::active()->where('show_banner', true)->get(),
                        'maintenanceOn' => Setting::where('key', 'maintenance_mode')->value('value') === '1',
                    ];
                } catch (\Exception $e) {
                    $shared = ['principal' => null, 'settings' => [], 'announcements' => collect(), 'maintenanceOn' => false];
                }
            }
            $view->with($shared);
        });

        // Auto-log admin page visits (for audit trail)
        if (!app()->runningInConsole()) {
            $this->app['events']->listen('Illuminate\Auth\Events\Login', function ($event) {
                try {
                    ActivityLog::create([
                        'user_id'     => $event->user->id,
                        'user_name'   => $event->user->name,
                        'action'      => 'login',
                        'description' => 'অ্যাডমিন লগইন করেছেন',
                        'ip_address'  => request()->ip(),
                    ]);
                } catch (\Exception $e) {
                }
            });

            $this->app['events']->listen('Illuminate\Auth\Events\Logout', function ($event) {
                try {
                    ActivityLog::create([
                        'user_id'     => $event->user?->id,
                        'user_name'   => $event->user?->name,
                        'action'      => 'logout',
                        'description' => 'অ্যাডমিন লগআউট করেছেন',
                        'ip_address'  => request()->ip(),
                    ]);
                } catch (\Exception $e) {
                }
            });
        }
    }
}
