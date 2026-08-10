@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-download"></i> {{ isset($download) ? 'ফাইল সম্পাদনা' : 'নতুন ফাইল' }}</h3><a
                href="{{ route('admin.downloads.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($download) ? route('admin.downloads.update', $download) : route('admin.downloads.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($download))
                    @method('PUT')
                @endif
                <div class="form-group"><label>শিরোনাম *</label><input type="text" name="title" class="form-control"
                        value="{{ old('title', $download->title ?? '') }}" required></div>
                <div class="form-row">
                    <div class="form-group"><label>বিভাগ</label><input type="text" name="category" class="form-control"
                            value="{{ old('category', $download->category ?? '') }}" placeholder="যেমন: ভর্তি, পরীক্ষা...">
                    </div>
                    <div class="form-group"><label>ক্রমিক নম্বর</label><input type="number" name="sort_order"
                            class="form-control" value="{{ old('sort_order', $download->sort_order ?? 0) }}"></div>
                </div>
                <div class="form-group"><label>ফাইল {{ isset($download) ? '' : '*' }}</label><input type="file"
                        name="file" class="form-control" {{ isset($download) ? '' : 'required' }}>
                    @if (isset($download) && $download->file)
                        <div style="margin-top:6px;font-size:12px"><a href="{{ asset('storage/' . $download->file) }}"
                                target="_blank" style="color:#1565C0">বিদ্যমান ফাইল</a></div>
                    @endif
                </div>
                <div class="form-group"><label
                        style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer"><input
                            type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $download->is_active ?? true) ? 'checked' : '' }}> সক্রিয় করুন</label>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        সংরক্ষণ</button><a href="{{ route('admin.downloads.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
