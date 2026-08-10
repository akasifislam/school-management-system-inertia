<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Admission::query();
        if ($request->filled('search')) $query->where(fn($q) => $q->where('name_bn', 'like', '%' . $request->search . '%')->orWhere('mobile', 'like', '%' . $request->search . '%'));
        if ($request->filled('class'))  $query->where('applying_class', $request->class);
        if ($request->filled('status')) $query->where('status', $request->status);
        $admissions = $query->latest()->paginate(20);
        return view('admin.pages.admissions_index', compact('admissions'));
    }

    public function show(Admission $admission)
    {
        return view('admin.pages.admissions_show', compact('admission'));
    }

    public function updateStatus(Request $request, Admission $admission)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $admission->update(['status' => $request->status]);
        return back()->with('success', 'অবস্থা পরিবর্তন হয়েছে।');
    }

    public function destroy(Admission $admission)
    {
        if ($admission->photo) Storage::disk('public')->delete($admission->photo);
        $admission->delete();
        return back()->with('success', 'আবেদন মুছে ফেলা হয়েছে।');
    }

    public function export()
    {
        $admissions = Admission::latest()->get();
        $csv = "\xEF\xBB\xBF" . "নাম (বাংলা),নাম (ইং),পিতার নাম,শ্রেণি,মোবাইল,অবস্থা,তারিখ\n";
        foreach ($admissions as $a) {
            $csv .= "\"{$a->name_bn}\",\"{$a->name_en}\",\"{$a->father_name}\",\"{$a->applying_class}\",\"{$a->mobile}\",\"{$a->status}\",\"{$a->created_at->format('d/m/Y')}\"\n";
        }
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="admissions_' . date('Y-m-d') . '.csv"']);
    }
}
