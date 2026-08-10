<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{About, Contact, Principal, Setting, PageContent, Student};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function config()
    {
        return view('admin.pages.config', [
            'about'     => About::first(),
            'contact'   => Contact::first(),
            'principal' => Principal::first(),
            'settings'  => Setting::pluck('value', 'key')->toArray(),
            'history'   => PageContent::where('key', 'history')->value('content'),
            'apa'       => PageContent::where('key', 'apa')->value('content'),
            'sudhachar' => PageContent::where('key', 'sudhachar')->value('content'),
        ]);
    }
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.pages.settings', compact('settings'));
    }
    public function update(Request $request)
    {
        $fields = ['school_name_bn', 'school_name_en', 'phone', 'email', 'website', 'map_embed', 'academic_year', 'footer_note', 'color_primary', 'color_primary_d', 'color_primary_l', 'color_accent', 'color_green', 'color_cyan'];
        foreach ($fields as $f) {
            Setting::updateOrCreate(['key' => $f], ['value' => $request->input($f)]);
        }
        if ($request->has('active_classes')) {
            Setting::updateOrCreate(['key' => 'active_classes'], ['value' => json_encode($request->active_classes)]);
        }
        foreach (['logo', 'banner'] as $img) {
            if ($request->hasFile($img)) {
                $old = Setting::where('key', $img)->first();
                if ($old?->value) Storage::disk('public')->delete($old->value);
                $path = $request->file($img)->store('settings', 'public');
                Setting::updateOrCreate(['key' => $img], ['value' => $path]);
            }
        }
        return back()->with('success', 'সেটিংস সংরক্ষণ হয়েছে।');
    }

    public function about()
    {
        return view('admin.pages.about', ['about' => About::first()]);
    }
    public function updateAbout(Request $request)
    {
        About::updateOrCreate(['id' => 1], $request->except(['_token', '_method']));
        return back()->with('success', 'বিদ্যালয় পরিচিতি আপডেট হয়েছে।');
    }

    public function history()
    {
        $history = PageContent::where('key', 'history')->value('content');
        return view('admin.pages.history', compact('history'));
    }
    public function updateHistory(Request $request)
    {
        PageContent::updateOrCreate(['key' => 'history'], ['content' => $request->content]);
        return back()->with('success', 'ইতিহাস আপডেট হয়েছে।');
    }

    public function principal()
    {
        return view('admin.pages.principal', ['principal' => Principal::first()]);
    }
    public function updatePrincipal(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:150', 'designation' => 'nullable|string|max:100', 'phone' => 'nullable|string|max:20', 'email' => 'nullable|email', 'joining_date' => 'nullable|date', 'message' => 'nullable|string', 'photo' => 'nullable|image|max:2048']);
        if ($request->hasFile('photo')) {
            $p = Principal::first();
            if ($p?->photo) Storage::disk('public')->delete($p->photo);
            $data['photo'] = $request->file('photo')->store('principal', 'public');
        }
        Principal::updateOrCreate(['id' => 1], $data);
        return back()->with('success', 'প্রধান শিক্ষকের তথ্য আপডেট হয়েছে।');
    }

    public function apa()
    {
        $content = PageContent::where('key', 'apa')->value('content');
        return view('admin.pages.apa', compact('content'));
    }
    public function updateApa(Request $request)
    {
        PageContent::updateOrCreate(['key' => 'apa'], ['content' => $request->content]);
        return back()->with('success', 'এপিএ আপডেট হয়েছে।');
    }

    public function sudhachar()
    {
        $content = PageContent::where('key', 'sudhachar')->value('content');
        return view('admin.pages.sudhachar', compact('content'));
    }
    public function updateSudhachar(Request $request)
    {
        PageContent::updateOrCreate(['key' => 'sudhachar'], ['content' => $request->content]);
        return back()->with('success', 'সুধাচার কৌশল আপডেট হয়েছে।');
    }

    public function contact()
    {
        return view('admin.pages.contact', ['contact' => Contact::first()]);
    }
    public function updateContact(Request $request)
    {
        Contact::updateOrCreate(['id' => 1], $request->except(['_token', '_method']));
        return back()->with('success', 'যোগাযোগ তথ্য আপডেট হয়েছে।');
    }
}
