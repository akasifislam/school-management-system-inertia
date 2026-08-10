<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notice; use App\Models\Teacher; use App\Models\Student;
use App\Models\StudentData; use App\Models\Admission; use App\Models\Download;
use App\Models\GalleryImage; use App\Models\ExamResult; use App\Models\NewsItem;
use Illuminate\Http\Request;

// ══════════════════════════════════════════════════════
// DASHBOARD
// ══════════════════════════════════════════════════════
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
        $recentNotices    = Notice::latest()->take(6)->get();
        $recentAdmissions = Admission::latest()->take(6)->get();
        return view('admin.pages.dashboard', compact('stats', 'recentNotices', 'recentAdmissions'));
    }
}
