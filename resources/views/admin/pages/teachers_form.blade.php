@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-chalkboard-teacher"></i> {{ isset($teacher) ? 'শিক্ষক সম্পাদনা' : 'নতুন শিক্ষক' }}</h3><a
                href="{{ route('admin.teachers.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a>
        </div>
        <div class="card-body">
            <form action="{{ isset($teacher) ? route('admin.teachers.update', $teacher) : route('admin.teachers.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($teacher))
                    @method('PUT')
                @endif
                <div style="display:flex;gap:24px;align-items:flex-start">
                    <div>
                        <img id="photoPreview"
                            src="{{ isset($teacher) && $teacher->photo ? asset('storage/' . $teacher->photo) : '' }}"
                            class="photo-preview"
                            style="{{ isset($teacher) && $teacher->photo ? '' : 'display:none;' }}width:100px;height:120px"
                            alt="">
                        <div class="form-group"><label>ছবি</label><input type="file" name="photo" class="form-control"
                                accept="image/*" data-preview="photoPreview"></div>
                    </div>
                    <div style="flex:1">
                        <div class="form-row">
                            <div class="form-group"><label>পিডিএস আইডি *</label><input type="text" name="pds_id"
                                    class="form-control @error('pds_id') is-invalid @enderror"
                                    value="{{ old('pds_id', $teacher->pds_id ?? '') }}" required>
                                @error('pds_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group"><label>নাম *</label><input type="text" name="name"
                                    class="form-control" value="{{ old('name', $teacher->name ?? '') }}" required></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>মূলপদ</label><input type="text" name="base_designation"
                                    class="form-control"
                                    value="{{ old('base_designation', $teacher->base_designation ?? '') }}"></div>
                            <div class="form-group"><label>বর্তমান পদবী *</label><input type="text"
                                    name="current_designation" class="form-control"
                                    value="{{ old('current_designation', $teacher->current_designation ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>যোগদানের তারিখ</label><input type="date" name="joining_date"
                                    class="form-control"
                                    value="{{ old('joining_date', isset($teacher) ? $teacher->joining_date?->format('Y-m-d') : '') }}">
                            </div>
                            <div class="form-group"><label>নিজ জেলা</label><input type="text" name="district"
                                    class="form-control" value="{{ old('district', $teacher->district ?? '') }}"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>মোবাইল নম্বর</label><input type="text" name="phone"
                                    class="form-control" value="{{ old('phone', $teacher->phone ?? '') }}"></div>
                            <div class="form-group"><label>ক্রমিক নম্বর</label><input type="number" name="sort_order"
                                    class="form-control" value="{{ old('sort_order', $teacher->sort_order ?? 0) }}"></div>
                        </div>
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        {{ isset($teacher) ? 'আপডেট' : 'সংরক্ষণ' }}</button><a href="{{ route('admin.teachers.index') }}"
                        class="btn" style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
