<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsItem::latest()->paginate(20);
        return view('admin.pages.news_index', compact('news'));
    }
    public function create() { return view('admin.pages.news_form'); }
    public function store(Request $request)
    {
        $request->validate(['title'=>'required|string|max:500','link'=>'nullable|url']);
        NewsItem::create(['title'=>$request->title,'link'=>$request->link,'is_active'=>$request->boolean('is_active',true)]);
        return redirect()->route('admin.news.index')->with('success','খবর যোগ হয়েছে।');
    }
    public function edit(NewsItem $newsItem) { return view('admin.pages.news_form', compact('newsItem')); }
    public function update(Request $request, NewsItem $newsItem)
    {
        $request->validate(['title'=>'required|string|max:500','link'=>'nullable|url']);
        $newsItem->update(['title'=>$request->title,'link'=>$request->link,'is_active'=>$request->boolean('is_active',true)]);
        return redirect()->route('admin.news.index')->with('success','খবর আপডেট হয়েছে।');
    }
    public function destroy(NewsItem $newsItem) { $newsItem->delete(); return back()->with('success','মুছে ফেলা হয়েছে।'); }
}
