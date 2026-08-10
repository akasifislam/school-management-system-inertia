<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{About, Contact, Teacher, StudentData, Student, GalleryImage, Notice, Download, ExamResult, Admission, PageContent};
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutOverview()
    {
        return view('frontend.pages.about_overview', ['about' => About::first()]);
    }

    public function history()
    {
        return view('frontend.pages.history', ['history' => PageContent::where('key', 'history')->value('content')]);
    }

    public function information()
    {
        $teachers = Teacher::orderBy('sort_order')->orderBy('id')->get();
        return view('frontend.pages.information', compact('teachers'));
    }

    public function studentsCount(Request $request)
    {
        $academicYears = range((int)date('Y') + 1, (int)date('Y') - 4);
        $query = StudentData::query();
        if ($request->filled('class'))   $query->where('class',   $request->class);
        if ($request->filled('shift'))   $query->where('shift',   $request->shift);
        if ($request->filled('section')) $query->where('section', $request->section);
        $studentData   = $query->orderByRaw("FIELD(`class`,'Six','Seven','Eight','Nine','Ten')")->orderBy('shift')->orderBy('section')->get();
        $hasFilter     = $request->filled('class') || $request->filled('shift') || $request->filled('section');
        $totalFiltered = $hasFilter ? $studentData->sum('total') : StudentData::sum('total');
        return view('frontend.pages.students_count', compact('studentData', 'academicYears', 'totalFiltered', 'hasFilter'));
    }

    public function studentsList(Request $request)
    {
        $query = Student::query();
        if ($request->filled('class'))   $query->where('class',   $request->class);
        if ($request->filled('shift'))   $query->where('shift',   $request->shift);
        if ($request->filled('section')) $query->where('section', $request->section);
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name_bn', 'like', "%$s%")->orWhere('name_en', 'like', "%$s%")->orWhere('roll_no', 'like', "%$s%"));
        }
        $students = $query->where('status', 'active')->orderBy('class')->orderBy('section')->orderBy('roll_no')->paginate(30);
        return view('frontend.pages.students_list', compact('students'));
    }

    public function results(Request $request)
    {
        $query = ExamResult::query();
        $years = ExamResult::selectRaw('DISTINCT year')->orderByDesc('year')->pluck('year');
        if ($request->filled('year'))      $query->where('year', $request->year);
        if ($request->filled('exam_type')) $query->where('exam_type', $request->exam_type);
        if ($request->filled('search'))    $query->where('title', 'like', '%' . $request->search . '%');
        $results = $query->latest()->paginate(12);
        return view('frontend.pages.results', compact('results', 'years'));
    }

    public function gallery()
    {
        $images = GalleryImage::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('frontend.pages.gallery', compact('images'));
    }

    public function contact()
    {
        return view('frontend.pages.contact', ['contact' => Contact::first()]);
    }

    public function apa()
    {
        return view('frontend.pages.apa', ['content' => PageContent::where('key', 'apa')->value('content')]);
    }

    public function sudhachar()
    {
        return view('frontend.pages.sudhachar', ['content' => PageContent::where('key', 'sudhachar')->value('content')]);
    }

    public function notices()
    {
        $notices = Notice::where('is_active', true)->orderBy('sort_order')->latest()->paginate(20);
        return view('frontend.pages.notices', compact('notices'));
    }

    public function downloads()
    {
        $downloads = Download::where('is_active', true)->orderBy('sort_order')->latest()->paginate(20);
        return view('frontend.pages.downloads', compact('downloads'));
    }

    public function admissionForm()
    {
        return view('frontend.pages.admission');
    }

    public function admissionStore(Request $request)
    {
        $data = $request->validate([
            'name_bn' => 'required|string|max:150',
            'name_en' => 'required|string|max:150',
            'father_name' => 'required|string|max:150',
            'mother_name' => 'required|string|max:150',
            'father_occupation' => 'nullable|string|max:100',
            'monthly_income' => 'nullable|string|max:50',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'religion' => 'required|string|max:20',
            'birth_cert_no' => 'nullable|string|max:50',
            'applying_class' => 'required|in:6,7,8,9',
            'prev_school' => 'nullable|string|max:200',
            'prev_class' => 'nullable|string|max:50',
            'prev_result' => 'nullable|string|max:50',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('admissions', 'public');
        $data['status'] = 'pending';
        Admission::create($data);
        return back()->with('success', 'আপনার ভর্তি আবেদন সফলভাবে জমা হয়েছে। আমরা শীঘ্রই আপনার মোবাইলে যোগাযোগ করব।');
    }
}
