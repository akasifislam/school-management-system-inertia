<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();
        if ($request->filled('search')) $query->where('name', 'like', '%' . $request->search . '%')->orWhere('pds_id', 'like', '%' . $request->search . '%');
        $teachers = $query->orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.pages.teachers_index', compact('teachers'));
    }
    public function create()
    {
        return view('admin.pages.teachers_form');
    }
    public function store(Request $request)
    {
        $data = $request->validate(['pds_id' => 'required|string|max:20|unique:teachers', 'name' => 'required|string|max:150', 'base_designation' => 'nullable|string|max:200', 'current_designation' => 'required|string|max:200', 'joining_date' => 'nullable|date', 'district' => 'nullable|string|max:100', 'phone' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer', 'photo' => 'nullable|image|max:2048']);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('teachers', 'public');
        Teacher::create($data);
        return redirect()->route('admin.teachers.index')->with('success', 'শিক্ষক যোগ হয়েছে।');
    }
    public function edit(Teacher $teacher)
    {
        return view('admin.pages.teachers_form', compact('teacher'));
    }
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate(['pds_id' => 'required|string|max:20|unique:teachers,pds_id,' . $teacher->id, 'name' => 'required|string|max:150', 'base_designation' => 'nullable|string|max:200', 'current_designation' => 'required|string|max:200', 'joining_date' => 'nullable|date', 'district' => 'nullable|string|max:100', 'phone' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer', 'photo' => 'nullable|image|max:2048']);
        if ($request->hasFile('photo')) {
            if ($teacher->photo) Storage::disk('public')->delete($teacher->photo);
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }
        $teacher->update($data);
        return redirect()->route('admin.teachers.index')->with('success', 'শিক্ষক আপডেট হয়েছে।');
    }
    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo) Storage::disk('public')->delete($teacher->photo);
        $teacher->delete();
        return back()->with('success', 'মুছে ফেলা হয়েছে।');
    }
}
