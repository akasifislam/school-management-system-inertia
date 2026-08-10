<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentDataController;
use App\Http\Controllers\Admin\StudentRecordController;
use App\Http\Controllers\Admin\ExamResultController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\MaintenanceController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about/overview', [PageController::class, 'aboutOverview'])->name('about.overview');
Route::get('/about/history',  [PageController::class, 'history'])->name('about.history');
Route::get('/information', [PageController::class, 'information'])->name('information');

// Students — 2 sub pages
Route::get('/students',       fn() => redirect()->route('students.count'))->name('students');
Route::get('/students/count', [PageController::class, 'studentsCount'])->name('students.count');
Route::get('/students/list',  [PageController::class, 'studentsList'])->name('students.list');

Route::get('/results', [PageController::class, 'results'])->name('results');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/apa',       [PageController::class, 'apa'])->name('apa');
Route::get('/sudhachar', [PageController::class, 'sudhachar'])->name('sudhachar');

Route::get('/notices',   [PageController::class, 'notices'])->name('notices');
Route::get('/downloads', [PageController::class, 'downloads'])->name('downloads');

// Admission
Route::get('/admission/apply',  [PageController::class, 'admissionForm'])->name('admission.apply');
Route::post('/admission/apply', [PageController::class, 'admissionStore'])->name('admission.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });
    Route::get(
        '/',
        fn() => auth()->check() && auth()->user()->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('admin.login')
    );
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/settings',  [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings',  [SettingsController::class, 'update'])->name('settings.update');
        Route::get('/config',    [SettingsController::class, 'config'])->name('config');
        Route::get('/about',     [SettingsController::class, 'about'])->name('about');
        Route::put('/about',     [SettingsController::class, 'updateAbout'])->name('about.update');
        Route::get('/history',   [SettingsController::class, 'history'])->name('history');
        Route::put('/history',   [SettingsController::class, 'updateHistory'])->name('history.update');
        Route::get('/principal', [SettingsController::class, 'principal'])->name('principal');
        Route::put('/principal', [SettingsController::class, 'updatePrincipal'])->name('principal.update');
        Route::get('/apa',       [SettingsController::class, 'apa'])->name('apa');
        Route::put('/apa',       [SettingsController::class, 'updateApa'])->name('apa.update');
        Route::get('/sudhachar', [SettingsController::class, 'sudhachar'])->name('sudhachar');
        Route::put('/sudhachar', [SettingsController::class, 'updateSudhachar'])->name('sudhachar.update');
        Route::get('/contact',   [SettingsController::class, 'contact'])->name('contact');
        Route::put('/contact',   [SettingsController::class, 'updateContact'])->name('contact.update');
        Route::get('/profile',   fn() => redirect()->route('admin.settings'))->name('profile');

        // CRUD Resources
        Route::resource('notices',   NoticeController::class)->except(['show']);
        Route::resource('news',      NewsController::class)->except(['show']);
        Route::resource('downloads', DownloadController::class)->except(['show']);
        Route::resource('gallery',   GalleryController::class)->except(['show']);
        Route::resource('teachers',  TeacherController::class)->except(['show']);
        Route::resource('students',  StudentDataController::class)->except(['show']);
        Route::resource('results',   ExamResultController::class)->except(['show']);

        // Student Records (individual)
        Route::get('/student-records/export',              [StudentRecordController::class, 'export'])->name('student-records.export');
        Route::get('/student-records',                     [StudentRecordController::class, 'index'])->name('student-records.index');
        Route::get('/student-records/create',              [StudentRecordController::class, 'create'])->name('student-records.create');
        Route::post('/student-records',                    [StudentRecordController::class, 'store'])->name('student-records.store');
        Route::get('/student-records/{student}/edit',      [StudentRecordController::class, 'edit'])->name('student-records.edit');
        Route::put('/student-records/{student}',           [StudentRecordController::class, 'update'])->name('student-records.update');
        Route::delete('/student-records/{student}',        [StudentRecordController::class, 'destroy'])->name('student-records.destroy');
        Route::patch('/student-records/{student}/status',  [StudentRecordController::class, 'updateStatus'])->name('student-records.status');
        Route::patch('/student-records/{student}/transfer', [StudentRecordController::class, 'transfer'])->name('student-records.transfer');

        // ══════════════════════════════════════
        // MAINTENANCE & CONTROLS
        // ══════════════════════════════════════

        // Maintenance Dashboard
        Route::get('/maintenance',                     [MaintenanceController::class, 'index'])->name('maintenance');
        Route::post('/maintenance/toggle',             [MaintenanceController::class, 'toggleMaintenance'])->name('maintenance.toggle');
        Route::post('/maintenance/cache-clear',        [MaintenanceController::class, 'clearCache'])->name('maintenance.cache-clear');

        // Site Controls (feature toggles)
        Route::get('/site-controls',                   [MaintenanceController::class, 'siteControls'])->name('site-controls');
        Route::post('/site-controls',                  [MaintenanceController::class, 'updateSiteControls'])->name('site-controls.update');

        // Announcements
        Route::get('/announcements',                   [MaintenanceController::class, 'announcements'])->name('announcements.index');
        Route::get('/announcements/create',            [MaintenanceController::class, 'announcementCreate'])->name('announcements.create');
        Route::post('/announcements',                  [MaintenanceController::class, 'announcementStore'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [MaintenanceController::class, 'announcementEdit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}',    [MaintenanceController::class, 'announcementUpdate'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [MaintenanceController::class, 'announcementDestroy'])->name('announcements.destroy');

        // Activity Logs
        Route::get('/activity-logs',                   [MaintenanceController::class, 'activityLogs'])->name('activity-logs');
        Route::post('/activity-logs/clear',            [MaintenanceController::class, 'clearLogs'])->name('activity-logs.clear');

        // Backup
        Route::get('/backup',                          [MaintenanceController::class, 'backup'])->name('backup');
        Route::post('/backup/create',                  [MaintenanceController::class, 'createBackup'])->name('backup.create');
        Route::get('/backup/download/{filename}',      [MaintenanceController::class, 'downloadBackup'])->name('backup.download');
        Route::delete('/backup/{filename}',            [MaintenanceController::class, 'deleteBackup'])->name('backup.delete');

        // System Info
        Route::get('/system-info',                     [MaintenanceController::class, 'systemInfo'])->name('system-info');

        // ══════════════════════════════════════
        // ADMISSIONS
        // ══════════════════════════════════════

        // Admissions
        Route::get('/admissions/export',               [AdmissionController::class, 'export'])->name('admissions.export');
        Route::get('/admissions',                      [AdmissionController::class, 'index'])->name('admissions.index');
        Route::get('/admissions/{admission}',          [AdmissionController::class, 'show'])->name('admissions.show');
        Route::patch('/admissions/{admission}/status', [AdmissionController::class, 'updateStatus'])->name('admissions.status');
        Route::delete('/admissions/{admission}',       [AdmissionController::class, 'destroy'])->name('admissions.destroy');
    });
});
