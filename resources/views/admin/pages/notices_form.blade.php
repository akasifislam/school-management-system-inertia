@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-bell"></i>
                {{ isset($notice) ? 'নোটিশ সম্পাদনা' : 'নতুন নোটিশ' }}
            </h3><a href="{{ route('admin.notices.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a>
        </div>

        <div class="card-body">
            <form action="{{ isset($notice) ? route('admin.notices.update', $notice) : route('admin.notices.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($notice))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label>নোটিশের শিরোনাম *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $notice->title ?? '') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"><label>বিবরণ</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $notice->description ?? '') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>ফাইল আপলোড (PDF/ছবি)</label>
                        <input type="file" name="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        @if (isset($notice) && $notice->file)
                            <div style="margin-top:6px;font-size:12px;color:#1565C0"><i class="fas fa-paperclip"></i>
                                <a href="{{ asset('storage/' . $notice->file) }}" target="_blank">বিদ্যমান ফাইল</a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>প্রকাশের তারিখ</label>
                        <input type="date" name="publish_date" class="form-control"
                            value="{{ old('publish_date', isset($notice) ? $notice->publish_date?->format('Y-m-d') : today()->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>ক্রমিক নম্বর</label>
                        <input type="number" name="sort_order" class="form-control"
                            value="{{ old('sort_order', $notice->sort_order ?? 0) }}">
                    </div>
                    <div class="form-group" style="display:flex;gap:20px;align-items:center;padding-top:28px">
                        <label style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $notice->is_active ?? true) ? 'checked' : '' }}> সক্রিয় করুন</label>
                        <label style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer"><input
                                type="checkbox" name="is_banner" value="1"
                                {{ old('is_banner', $notice->is_banner ?? false) ? 'checked' : '' }}> হোম ব্যানার</label>
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        {{ isset($notice) ? 'আপডেট' : 'সংরক্ষণ' }}</button><a href="{{ route('admin.notices.index') }}"
                        class="btn" style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
