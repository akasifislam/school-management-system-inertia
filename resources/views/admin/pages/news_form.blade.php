@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-newspaper"></i> {{ isset($newsItem) ? 'খবর সম্পাদনা' : 'নতুন খবর' }}</h3><a
                href="{{ route('admin.news.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a>
        </div>
        <div class="card-body">
            <form action="{{ isset($newsItem) ? route('admin.news.update', $newsItem) : route('admin.news.store') }}"
                method="POST">
                @csrf @if (isset($newsItem))
                    @method('PUT')
                @endif
                <div class="form-group"><label>শিরোনাম *</label><input type="text" name="title" class="form-control"
                        value="{{ old('title', $newsItem->title ?? '') }}" required></div>
                <div class="form-group"><label>লিংক (ঐচ্ছিক)</label><input type="url" name="link"
                        class="form-control" value="{{ old('link', $newsItem->link ?? '') }}" placeholder="https://...">
                </div>
                <div class="form-group"><label
                        style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer"><input
                            type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $newsItem->is_active ?? true) ? 'checked' : '' }}> সক্রিয় করুন (টিকারে
                        দেখাবে)</label></div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        সংরক্ষণ</button><a href="{{ route('admin.news.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
