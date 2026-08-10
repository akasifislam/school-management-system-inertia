@extends('layouts.admin')

@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-image"></i> {{ isset($image) ? 'ছবি সম্পাদনা' : 'নতুন ছবি যোগ করুন' }}
            </h3>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9">
                <i class="fas fa-arrow-left"></i>
                ফিরে যান
            </a>
        </div>
        <div class="card-body">
            <form action="{{ isset($image) ? route('admin.gallery.update', $image) : route('admin.gallery.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($image))
                    @method('PUT')
                @endif
                <div style="display:flex;gap:20px;align-items:flex-start">
                    <div>
                        @if (isset($image) && $image->image)
                            <img src="{{ asset('storage/' . $image->image) }}"
                                style="width:150px;height:120px;object-fit:cover;border:1px solid #dde1e9;border-radius:6px;margin-bottom:8px"
                                alt="">
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*"
                            {{ isset($image) ? '' : 'required' }}>
                    </div>

                    <div style="flex:1">
                        <div class="form-group"><label>ক্যাপশন</label><input type="text" name="caption"
                                class="form-control" value="{{ old('caption', $image->caption ?? '') }}"></div>
                        <div class="form-group"><label>ক্রমিক নম্বর</label><input type="number" name="sort_order"
                                class="form-control" value="{{ old('sort_order', $image->sort_order ?? 0) }}"></div>
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        সংরক্ষণ</button><a href="{{ route('admin.gallery.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
