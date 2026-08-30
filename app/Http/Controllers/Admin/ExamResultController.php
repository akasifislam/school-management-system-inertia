<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamResultController extends Controller
{
    public function index(Request $request)
    {
        $query = ExamResult::query();
        $years = ExamResult::selectRaw('DISTINCT year')->orderByDesc('year')->pluck('year');
        if ($request->filled('search')) $query->where('title', 'like', '%' . $request->search . '%');
        if ($request->filled('year'))   $query->where('year', $request->year);
        if ($request->filled('exam_type')) $query->where('exam_type', $request->exam_type);
        $results = $query->latest()->paginate(10);
        return view('admin.pages.results_index', compact('results', 'years'));
    }
    public function create()
    {
        return view('admin.pages.results_form');
    }
    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:300', 'exam_type' => 'required|string|max:50', 'year' => 'required|integer|min:2000|max:2099', 'description' => 'nullable|string', 'file' => 'required|file|max:10240']);
        $data['file'] = $request->file('file')->store('results', 'public');
        ExamResult::create($data);
        return redirect()->route('admin.results.index')->with('success', 'ফলাফল যোগ হয়েছে।');
    }
    public function edit(ExamResult $result)
    {
        return view('admin.pages.results_form', compact('result'));
    }
    public function update(Request $request, ExamResult $result)
    {
        $data = $request->validate(['title' => 'required|string|max:300', 'exam_type' => 'required|string|max:50', 'year' => 'required|integer|min:2000|max:2099', 'description' => 'nullable|string', 'file' => 'nullable|file|max:10240']);

        if ($request->hasFile('file')) {
            if ($result->file) Storage::disk('public')->delete($result->file);
            $data['file'] = $request->file('file')->store('results', 'public');
        }

        $result->update($data);
        return redirect()->route('admin.results.index')->with('success', 'ফলাফল আপডেট হয়েছে।');
    }



    public function destroy(ExamResult $result)
    {
        if ($result->file) Storage::disk('public')->delete($result->file);
        $result->delete();
        return back()->with('success', 'মুছে ফেলা হয়েছে।');
    }
}
