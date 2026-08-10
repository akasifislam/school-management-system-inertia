@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">সংক্ষিপ্ত ইতিহাস</div>
    <div class="p-page">{!! $history ?? '<p style="color:#999">তথ্য শীঘ্রই আসছে।</p>' !!}</div>
@endsection
