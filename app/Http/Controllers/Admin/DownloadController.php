<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderBy('sort_order')->latest()->paginate(15);
        return view('admin.pages.downloads_index', compact('downloads'));
    }
    public function create()
    {
        return view('admin.pages.downloads_form');
    }
    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:300', 'category' => 'nullable|string|max:100', 'file' => 'required|file|max:20480', 'sort_order' => 'nullable|integer']);
        $data['file'] = $request->file('file')->store('downloads', 'public');
        $data['is_active'] = $request->boolean('is_active', true);
        Download::create($data);
        return redirect()->route('admin.downloads.index')->with('success', 'ফাইল যোগ হয়েছে।');
    }
    public function edit(Download $download)
    {
        return view('admin.pages.downloads_form', compact('download'));
    }
    public function update(Request $request, Download $download)
    {
        $data = $request->validate(['title' => 'required|string|max:300', 'category' => 'nullable|string|max:100', 'file' => 'nullable|file|max:20480', 'sort_order' => 'nullable|integer']);

        if ($request->hasFile('file')) {
            if ($download->file) Storage::disk('public')->delete($download->file);
            $data['file'] = $request->file('file')->store('downloads', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $download->update($data);
        return redirect()->route('admin.downloads.index')->with('success', 'ফাইল আপডেট হয়েছে।');
    }
    public function destroy(Download $download)
    {
        if ($download->file) Storage::disk('public')->delete($download->file);
        $download->delete();
        return back()->with('success', 'মুছে ফেলা হয়েছে।');
    }
}
