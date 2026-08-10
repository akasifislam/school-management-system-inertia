@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-images"></i> ছবির গ্যালারী</h3><a href="{{ route('admin.gallery.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> ছবি যোগ করুন</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:14px;padding:18px">
            @forelse($images as $img)
                <div style="border:1px solid #dde1e9;border-radius:6px;overflow:hidden;background:#f9f9f9">

                    <img src="{{ asset('storage/' . $img->image) }}"
                        style="width:100%;height:120px;object-fit:cover;display:block" alt="" loading="lazy">

                    <div style="padding:8px">
                        <p style="font-size:12px;color:#555;margin-bottom:6px">
                            {{ \Illuminate\Support\Str::limit($img->caption, 25) ?? '—' }}</p>
                        <div style="display:flex;gap:5px">
                            <a href="{{ route('admin.gallery.edit', $img) }}" class="btn btn-icon edit"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.gallery.destroy', $img) }}" method="POST">@csrf
                                @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                    data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
                        </div>
                    </div>
                </div>
            @empty<div style="grid-column:1/-1" class="empty-state"><i class="fas fa-images"></i>
                    <h3>কোনো ছবি নেই</h3><a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"
                        style="margin-top:12px"><i class="fas fa-plus"></i> ছবি যোগ করুন</a>
                </div>
            @endforelse
        </div>
        <div class="pagination-wrap">{{ $images->links() }}</div>
    </div>
@endsection
