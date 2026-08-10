@extends('layouts.admin')
@section('content')
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-file-alt"></i> ভর্তি আবেদনের বিস্তারিত</h3><a href="{{ route('admin.admissions.index') }}" class="btn btn-sm" style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a></div>
<div class="card-body">
<div style="display:grid;grid-template-columns:auto 1fr;gap:28px;align-items:start">
<div style="text-align:center">
@if($admission->photo)<img src="{{ asset('storage/'.$admission->photo) }}" style="width:130px;height:150px;object-fit:cover;border:2px solid #dde1e9;border-radius:6px">@else<div style="width:130px;height:150px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;border:2px solid #dde1e9;border-radius:6px"><i class="fas fa-user" style="font-size:48px;color:#bbb"></i></div>@endif
<div style="margin-top:10px">
<form action="{{ route('admin.admissions.status',$admission) }}" method="POST">@csrf @method('PATCH')
<select name="status" class="form-control" style="text-align:center;margin-bottom:8px" onchange="this.form.submit()">
<option value="pending"  {{ $admission->status=='pending' ?'selected':'' }}>অপেক্ষমান</option>
<option value="approved" {{ $admission->status=='approved'?'selected':'' }}>অনুমোদিত</option>
<option value="rejected" {{ $admission->status=='rejected'?'selected':'' }}>বাতিল</option>
</select>
</form>
</div>
</div>
<table style="width:100%;border-collapse:collapse;font-size:13px">
@php $rows=['নাম (বাংলায়)'=>$admission->name_bn,'নাম (ইংরেজিতে)'=>$admission->name_en,'পিতার নাম'=>$admission->father_name,'মাতার নাম'=>$admission->mother_name,'পিতার পেশা'=>$admission->father_occupation??'—','মাসিক আয়'=>$admission->monthly_income??'—','জন্ম তারিখ'=>$admission->dob?->format('d/m/Y')??'—','লিঙ্গ'=>$admission->gender==='male'?'ছেলে':'মেয়ে','ধর্ম'=>$admission->religion,'জন্ম নিবন্ধন'=>$admission->birth_cert_no??'—','আবেদনকৃত শ্রেণি'=>'শ্রেণি '.$admission->applying_class,'পূর্ববর্তী বিদ্যালয়'=>$admission->prev_school??'—','পূর্ববর্তী শ্রেণি'=>$admission->prev_class??'—','GPA / ফলাফল'=>$admission->prev_result??'—','মোবাইল নম্বর'=>$admission->mobile,'ইমেইল'=>$admission->email??'—','ঠিকানা'=>$admission->address,'আবেদনের তারিখ'=>$admission->created_at->format('d/m/Y h:i A')]; @endphp
@foreach($rows as $label=>$value)
<tr style="border-bottom:1px solid #eef0f4"><td style="padding:7px 16px;font-weight:700;color:#78909C;width:38%;text-align:right">{{ $label }}</td><td style="padding:7px 16px;color:#263238">{{ $value }}</td></tr>
@endforeach
</table>
</div>
<div style="margin-top:18px;padding-top:14px;border-top:1px solid #eef0f4">
<form action="{{ route('admin.admissions.destroy',$admission) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i> মুছে ফেলুন</button></form>
</div>
</div>
</div>
@endsection
