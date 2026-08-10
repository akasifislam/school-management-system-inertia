<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $isMaintenanceOn = false;
        try {
            $isMaintenanceOn = Setting::where('key', 'maintenance_mode')->value('value') === '1';
        } catch (\Exception $e) {
        }
        if ($isMaintenanceOn) {
            if (Auth::check() && Auth::user()->is_admin) {
                return $next($request);
            }
            $message = Setting::where('key', 'maintenance_message')->value('value')
                ?? 'সাইটটি সাময়িকভাবে রক্ষণাবেক্ষণের জন্য বন্ধ আছে। শীঘ্রই ফিরে আসছি।';

            return response()->view('maintenance', ['message' => $message], 503);
        }

        return $next($request);
    }
}
