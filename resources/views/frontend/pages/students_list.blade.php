@extends('layouts.frontend')
@section('content')
<div class="page-hdr">অধ্যয়নরত শিক্ষার্থীর তালিকা</div>
<form method="GET" action="{{ route('students.list') }}" class="filter-row" style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr auto;gap:8px;padding:12px 14px;background:#f8f9fa;border-bottom:1px solid #e0e0e0">
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">শ্রেণি</label><select name="class" class="filter-sel" style="width:100%"><option value="">সব শ্রেণি</option>@foreach(['Six','Seven','Eight','Nine','Ten'] as $c)<option value="{{ $c }}" {{ request('class')==$c?'selected':'' }}>{{ $c }}</option>@endforeach</select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">শিফট</label><select name="shift" class="filter-sel" style="width:100%"><option value="">সব শিফট</option><option value="Day" {{ request('shift')=='Day'?'selected':'' }}>Day</option><option value="Morning" {{ request('shift')=='Morning'?'selected':'' }}>Morning</option></select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">সেকশন</label><select name="section" class="filter-sel" style="width:100%"><option value="">সব সেকশন</option>@foreach(['A','B','C','D','E'] as $s)<option value="{{ $s }}" {{ request('section')==$s?'selected':'' }}>{{ $s }}</option>@endforeach</select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">নাম / রোল</label><input type="text" name="search" value="{{ request('search') }}" class="filter-sel" style="width:100%" placeholder="নাম বা রোল..."></div>
<div style="align-self:flex-end"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></div>
</form>
<div style="padding:7px 14px;background:#fff;border-bottom:1px solid #eee;font-size:12px;color:#546E7A">মোট: <strong style="color:#1565C0">{{ $students->total() }}</strong></div>
<div style="overflow-x:auto">
<table class="list-tbl">
<thead><tr><th>#</th><th>রোল</th><th>নাম (বাংলায়)</th><th>নাম (ইংরেজিতে)</th><th>শ্রেণি</th><th>শিফট</th><th>সেকশন</th><th>লিঙ্গ</th><th>অবস্থা</th></tr></thead>
<tbody>
@forelse($students as $i => $s)
<tr><td>{{ $students->firstItem()+$i }}</td><td>{{ $s->roll_no??'—' }}</td><td><strong>{{ $s->name_bn }}</strong></td><td style="color:#888;font-size:12px">{{ $s->name_en }}</td><td>{{ $s->class }}</td><td>{{ $s->shift }}</td><td>{{ $s->section??'—' }}</td><td>{{ $s->gender=='male'?'ছেলে':'মেয়ে' }}</td><td><span class="{{ $s->status=='active'?'badge-act':'badge-ina' }}">{{ $s->status=='active'?'সক্রিয়':'নিষ্ক্রিয়' }}</span></td></tr>
@empty
<tr><td colspan="9" style="text-align:center;padding:40px;color:#999"><i class="fas fa-user-graduate" style="font-size:30px;display:block;margin-bottom:10px;opacity:.3"></i>কোনো শিক্ষার্থী পাওয়া যায়নি।</td></tr>
@endforelse
</tbody>
</table>
</div>
@if($students->hasPages())<div style="padding:12px 14px;border-top:1px solid #eee">{{ $students->appends(request()->all())->links() }}</div>@endif
@endsection
