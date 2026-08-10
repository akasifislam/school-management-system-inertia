<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $query = Notice::query();
        if ($request->filled('search')) $query->where('title', 'like', '%' . $request->search . '%');
        if ($request->filled('status')) $query->where('is_active', $request->status);
        $notices = $query->orderBy('sort_order')->latest()->paginate(15);
        return view('admin.pages.notices_index', compact('notices'));
    }
    public function create()
    {
        return view('admin.pages.notices_form');
    }
    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:500', 'description' => 'nullable|string', 'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', 'publish_date' => 'nullable|date', 'sort_order' => 'nullable|integer']);
        if ($request->hasFile('file')) $data['file'] = $request->file('file')->store('notices', 'public');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_banner']  = $request->boolean('is_banner');
        Notice::create($data);
        return redirect()->route('admin.notices.index')->with('success', 'নোটিশ যোগ হয়েছে।');
    }
    public function edit(Notice $notice)
    {
        return view('admin.pages.notices_form', compact('notice'));
    }
    public function update(Request $request, Notice $notice)
    {
        $data = $request->validate(['title' => 'required|string|max:500', 'description' => 'nullable|string', 'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', 'publish_date' => 'nullable|date', 'sort_order' => 'nullable|integer']);
        if ($request->hasFile('file')) {
            if ($notice->file) Storage::disk('public')->delete($notice->file);
            $data['file'] = $request->file('file')->store('notices', 'public');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_banner'] = $request->boolean('is_banner');
        $notice->update($data);
        return redirect()->route('admin.notices.index')->with('success', 'নোটিশ আপডেট হয়েছে।');
    }
    public function destroy(Notice $notice)
    {
        if ($notice->file) Storage::disk('public')->delete($notice->file);
        $notice->delete();
        return back()->with('success', 'নোটিশ মুছে ফেলা হয়েছে।');
    }
}
