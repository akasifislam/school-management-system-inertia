@extends('layouts.admin')
@section('content')
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-file-alt"></i> ভর্তি আবেদন তালিকা</h3><a href="{{ route('admin.admissions.export') }}" class="btn btn-success btn-sm"><i class="fas fa-file-csv"></i> CSV এক্সপোর্ট</a></div>
<div class="filter-bar">
<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
<input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="নাম বা মোবাইল..." style="max-width:220px">
<select name="class" class="form-control" style="max-width:130px"><option value="">সব শ্রেণি</option>@foreach(['6','7','8','9'] as $c)<option value="{{ $c }}" {{ request('class')==$c?'selected':'' }}>শ্রেণি {{ $c }}</option>@endforeach</select>
<select name="status" class="form-control" style="max-width:140px"><option value="">সব অবস্থা</option><option value="pending" {{ request('status')=='pending'?'selected':'' }}>অপেক্ষমান</option><option value="approved" {{ request('status')=='approved'?'selected':'' }}>অনুমোদিত</option><option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>বাতিল</option></select>
<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
</form>
</div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>ছবি</th><th>নাম</th><th>পিতার নাম</th><th>শ্রেণি</th><th>মোবাইল</th><th>অবস্থা</th><th>তারিখ</th><th>অ্যাকশন</th></tr></thead>
<tbody>
@forelse($admissions as $i=>$a)
<tr>
<td>{{ $admissions->firstItem()+$i }}</td>
<td>@if($a->photo)<img src="{{ asset('storage/'.$a->photo) }}" style="width:38px;height:44px;object-fit:cover;border:1px solid #ddd" alt="">@else<div style="width:38px;height:44px;background:#f0f0f0;display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="color:#bbb"></i></div>@endif</td>
<td><strong>{{ $a->name_bn }}</strong><div style="font-size:12px;color:#888">{{ $a->name_en }}</div></td>
<td>{{ $a->father_name }}</td>
<td style="text-align:center">{{ $a->applying_class }}</td>
<td>{{ $a->mobile }}</td>
<td>
<form action="{{ route('admin.admissions.status',$a) }}" method="POST">@csrf @method('PATCH')
<select name="status" class="form-control" style="padding:3px 6px;font-size:12px;min-width:105px" onchange="this.form.submit()">
<option value="pending"  {{ $a->status=='pending' ?'selected':'' }}>অপেক্ষমান</option>
<option value="approved" {{ $a->status=='approved'?'selected':'' }}>অনুমোদিত</option>
<option value="rejected" {{ $a->status=='rejected'?'selected':'' }}>বাতিল</option>
</select>
</form>
</td>
<td>{{ $a->created_at->format('d/m/Y') }}</td>
<td><div style="display:flex;gap:4px"><a href="{{ route('admin.admissions.show',$a) }}" class="btn btn-icon" title="দেখুন"><i class="fas fa-eye" style="color:#1565C0"></i></a><form action="{{ route('admin.admissions.destroy',$a) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
@empty<tr><td colspan="9"><div class="empty-state"><i class="fas fa-file-alt"></i><h3>কোনো আবেদন নেই</h3></div></td></tr>
@endforelse
</tbody></table></div>
<div class="pagination-wrap">{{ $admissions->links() }}</div>
</div>
@endsection
