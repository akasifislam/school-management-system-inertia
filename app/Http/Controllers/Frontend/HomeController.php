<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Notice, Download, NewsItem};

class HomeController extends Controller
{
    public function index()
    {
        $notices      = Notice::where('is_active', true)->orderBy('sort_order')->latest()->take(6)->get();
        $downloads    = Download::where('is_active', true)->orderBy('sort_order')->latest()->take(5)->get();
        $newsItems    = NewsItem::where('is_active', true)->latest()->take(10)->get();
        $bannerNotice = Notice::where('is_active', true)->where('is_banner', true)->latest()->first();
        return view('frontend.pages.home', compact('notices', 'downloads', 'newsItems', 'bannerNotice'));
    }
}
