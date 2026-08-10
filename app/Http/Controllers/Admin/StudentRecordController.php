<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name_bn','like',"%$s%")->orWhere('name_en','like',"%$s%")->orWhere('roll_no','like',"%$s%")->orWhere('mobile','like',"%$s%"));
        }
        if ($request->filled('class'))   $query->where('class',   $request->class);
        if ($request->filled('shift'))   $query->where('shift',   $request->shift);
        if ($request->filled('section')) $query->where('section', $request->section);
        if ($request->filled('status'))  $query->where('status',  $request->status);
        $students = $query->orderBy('class')->orderBy('section')->orderBy('roll_no')->paginate(25);
        return view('admin.pages.student_records_index', compact('students'));
    }

    public function create() { return view('admin.pages.student_records_form'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_bn'=>'required|string|max:150','name_en'=>'nullable|string|max:150',
            'father_name'=>'nullable|string|max:150','mother_name'=>'nullable|string|max:150',
            'father_occupation'=>'nullable|string|max:100','monthly_income'=>'nullable|string|max:50',
            'dob'=>'nullable|date','gender'=>'nullable|in:male,female','religion'=>'nullable|string|max:20',
            'birth_cert_no'=>'nullable|string|max:50','class'=>'required|in:Six,Seven,Eight,Nine,Ten',
            'shift'=>'required|in:Day,Morning','section'=>'nullable|in:A,B,C,D,E',
            'roll_no'=>'nullable|string|max:30','mobile'=>'nullable|string|max:20',
            'email'=>'nullable|email','address'=>'nullable|string',
            'prev_school'=>'nullable|string|max:200','prev_class'=>'nullable|string|max:50',
            'prev_result'=>'nullable|string|max:50','academic_year'=>'nullable|string|max:10',
            'photo'=>'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('students','public');
        $data['status'] = 'active';
        Student::create($data);
        return redirect()->route('admin.student-records.index')->with('success','শিক্ষার্থী যোগ হয়েছে।');
    }

    public function edit(Student $student) { return view('admin.pages.student_records_form', compact('student')); }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name_bn'=>'required|string|max:150','name_en'=>'nullable|string|max:150',
            'father_name'=>'nullable|string|max:150','mother_name'=>'nullable|string|max:150',
            'father_occupation'=>'nullable|string|max:100','monthly_income'=>'nullable|string|max:50',
            'dob'=>'nullable|date','gender'=>'nullable|in:male,female','religion'=>'nullable|string|max:20',
            'birth_cert_no'=>'nullable|string|max:50','class'=>'required|in:Six,Seven,Eight,Nine,Ten',
            'shift'=>'required|in:Day,Morning','section'=>'nullable|in:A,B,C,D,E',
            'roll_no'=>'nullable|string|max:30','mobile'=>'nullable|string|max:20',
            'email'=>'nullable|email','address'=>'nullable|string',
            'prev_school'=>'nullable|string|max:200','prev_class'=>'nullable|string|max:50',
            'prev_result'=>'nullable|string|max:50','academic_year'=>'nullable|string|max:10',
            'status'=>'nullable|in:active,inactive,transferred','photo'=>'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) { if($student->photo) Storage::disk('public')->delete($student->photo); $data['photo']=$request->file('photo')->store('students','public'); }
        $student->update($data);
        return redirect()->route('admin.student-records.index')->with('success','শিক্ষার্থী আপডেট হয়েছে।');
    }

    public function destroy(Student $student)
    {
        if($student->photo) Storage::disk('public')->delete($student->photo);
        $student->delete();
        return back()->with('success','শিক্ষার্থী মুছে ফেলা হয়েছে।');
    }

    public function updateStatus(Request $request, Student $student)
    {
        $request->validate(['status'=>'required|in:active,inactive,transferred']);
        $student->update(['status'=>$request->status]);
        return back()->with('success','অবস্থা পরিবর্তন হয়েছে।');
    }

    public function transfer(Request $request, Student $student)
    {
        $request->validate(['class'=>'required|in:Six,Seven,Eight,Nine,Ten','shift'=>'required|in:Day,Morning','section'=>'nullable|in:A,B,C,D,E','transfer_note'=>'nullable|string|max:500']);
        $student->update(['class'=>$request->class,'shift'=>$request->shift,'section'=>$request->section,'transfer_note'=>$request->transfer_note]);
        return back()->with('success','ট্রান্সফার সম্পন্ন হয়েছে।');
    }

    public function export()
    {
        $students = Student::orderBy('class')->orderBy('section')->orderBy('roll_no')->get();
        $csv = "\xEF\xBB\xBF"."রোল,নাম (বাংলা),নাম (ইং),পিতার নাম,শ্রেণি,শিফট,সেকশন,মোবাইল,অবস্থা,একাডেমিক বছর\n";
        foreach ($students as $s) {
            $csv .= "\"{$s->roll_no}\",\"{$s->name_bn}\",\"{$s->name_en}\",\"{$s->father_name}\",\"{$s->class}\",\"{$s->shift}\",\"{$s->section}\",\"{$s->mobile}\",\"{$s->status}\",\"{$s->academic_year}\"\n";
        }
        return response($csv,200,['Content-Type'=>'text/csv; charset=UTF-8','Content-Disposition'=>'attachment; filename="students_'.date('Y-m-d').'.csv"']);
    }
}
