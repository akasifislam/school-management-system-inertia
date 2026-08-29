<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Teacher;
use App\Models\StudentData;
use App\Models\Admission;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students'   => StudentData::sum('total') ?: 833,
            'teachers'   => Teacher::count(),
            'notices'    => Notice::where('is_active', true)->count(),
            'admissions' => Admission::where('status', 'pending')->count(),
        ];
        $recentNotices    = Notice::latest()->take(10)->get();
        $recentAdmissions = Admission::latest()->take(10)->get();
        return view('admin.pages.dashboard', compact('stats', 'recentNotices', 'recentAdmissions'));
    }
}
