@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-cog"></i> পেজ সম্পাদনা (principal)
            </h3>
        </div>
        <div class="card-body">
            <p style="color:#888;font-size:13px">এই পেজের কন্টেন্ট Config পেজ থেকে সম্পাদনা করুন।</p><a
                href="{{ route('admin.config') }}#section-principal" class="btn btn-primary" style="margin-top:12px">
                <i class="fas fa-sliders-h"></i> Config পেজে যান</a>
        </div>
    </div>
@endsection
