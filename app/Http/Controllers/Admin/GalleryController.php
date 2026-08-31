<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.pages.gallery_index', compact('images'));
    }
    public function create()
    {
        return view('admin.pages.gallery_form');
    }
    public function store(Request $request)
    {
        $request->validate(['image' => 'required|image|max:4096', 'caption' => 'nullable|string|max:200', 'sort_order' => 'nullable|integer']);
        GalleryImage::create(['image' => $request->file('image')->store('gallery', 'public'), 'caption' => $request->caption, 'sort_order' => $request->sort_order ?? 0]);
        return redirect()->route('admin.gallery.index')->with('success', 'ছবি যোগ হয়েছে।');
    }

    public function edit(GalleryImage $galleryImage)
    {
        $image = $galleryImage;
        return view('admin.pages.gallery_form', compact('image'));
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $request->validate(['image' => 'nullable|image|max:4096', 'caption' => 'nullable|string|max:200', 'sort_order' => 'nullable|integer']);
        $data = ['caption' => $request->caption, 'sort_order' => $request->sort_order ?? 0];
        if ($request->hasFile('image')) {
            if ($galleryImage->image) Storage::disk('public')->delete($galleryImage->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }
        $galleryImage->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'ছবি আপডেট হয়েছে।');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        if ($galleryImage->image) Storage::disk('public')->delete($galleryImage->image);
        $galleryImage->delete();
        return back()->with('success', 'মুছে ফেলা হয়েছে।');
    }
}
