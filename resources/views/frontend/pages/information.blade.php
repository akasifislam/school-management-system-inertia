@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">
        কর্মরত শিক্ষক-শিক্ষিকা</div>
    <div style="overflow-x:auto">
        <table class="teacher-tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ছবি</th>
                    <th>পিডিএস আইডি / নাম</th>
                    <th>বর্তমান পদবী</th>
                    <th>যোগদান</th>
                    <th>জেলা</th>
                    <th>মোবাইল</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $i => $t)
                    <tr>
                        <td style="text-align:center">{{ $i + 1 }}</td>
                        <td>
                            @if ($t->photo)
                            <img src="{{ asset('storage/' . $t->photo) }}" class="teacher-photo-sm" alt="">@else<div
                                    style="width:44px;height:50px;background:#f0f0f0;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-user" style="color:#bbb"></i></div>
                            @endif
                        </td>
                        <td>
                            <div style="font-size:11px;color:#888">{{ $t->pds_id }}</div>
                            <strong>{{ $t->name }}</strong>
                            <div style="font-size:11px;color:#888">{{ $t->base_designation }}</div>
                        </td>
                        <td>{{ $t->current_designation }}</td>
                        <td style="white-space:nowrap">{{ $t->joining_date?->format('d.m.Y') }}</td>
                        <td>{{ $t->district }}</td>
                        <td>{{ $t->phone }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:30px;color:#999">কোনো তথ্য নেই।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
