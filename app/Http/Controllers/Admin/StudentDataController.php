<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentData;
use Illuminate\Http\Request;

class StudentDataController extends Controller
{
    public function index()
    {
        $studentData = StudentData::orderByRaw("FIELD(`class`,'Six','Seven','Eight','Nine','Ten')")->orderBy('shift')->orderBy('section')->paginate(30);
        return view('admin.pages.students_index', compact('studentData'));
    }
    public function create()
    {
        return view('admin.pages.students_form');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['class' => 'required|in:Six,Seven,Eight,Nine,Ten', 'shift' => 'required|in:Day,Morning', 'section' => 'nullable|in:A,B,C,D,E', 'total' => 'nullable|integer|min:0', 'boys' => 'nullable|integer|min:0', 'girls' => 'nullable|integer|min:0', 'muslim' => 'nullable|integer|min:0', 'hindu' => 'nullable|integer|min:0', 'buddhist' => 'nullable|integer|min:0', 'christian' => 'nullable|integer|min:0', 'ff_science' => 'nullable|integer|min:0', 'ff_general' => 'nullable|integer|min:0', 'autistic' => 'nullable|integer|min:0', 'physical' => 'nullable|integer|min:0']);
        StudentData::create($data);
        return redirect()->route('admin.students.index')->with('success', 'রেকর্ড যোগ হয়েছে।');
    }

    public function edit(StudentData $studentData)
    {
        $studentRow = $studentData;
        return view('admin.pages.students_form', compact('studentRow'));
    }

    public function update(Request $request, StudentData $studentData)
    {
        $data = $request->validate(['class' => 'required|in:Six,Seven,Eight,Nine,Ten', 'shift' => 'required|in:Day,Morning', 'section' => 'nullable|in:A,B,C,D,E', 'total' => 'nullable|integer|min:0', 'boys' => 'nullable|integer|min:0', 'girls' => 'nullable|integer|min:0', 'muslim' => 'nullable|integer|min:0', 'hindu' => 'nullable|integer|min:0', 'buddhist' => 'nullable|integer|min:0', 'christian' => 'nullable|integer|min:0', 'ff_science' => 'nullable|integer|min:0', 'ff_general' => 'nullable|integer|min:0', 'autistic' => 'nullable|integer|min:0', 'physical' => 'nullable|integer|min:0']);
        $studentData->update($data);
        return redirect()->route('admin.students.index')->with('success', 'রেকর্ড আপডেট হয়েছে।');
    }
    public function destroy(StudentData $studentData)
    {
        $studentData->delete();
        return back()->with('success', 'মুছে ফেলা হয়েছে।');
    }
}
