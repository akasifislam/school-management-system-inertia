@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">ছবির গ্যালারী</div>
    <div class="gallery-grid">
        @forelse($images as $img)
            <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $img->image) }}','{{ $img->caption }}')">
                <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->caption ?? 'Gallery' }}" loading="lazy">
            </div>
        @empty
            <div style="grid-column:1/-1;text-align:center;padding:40px;color:#999">কোনো ছবি নেই।</div>
        @endforelse
    </div>
    @if ($images->hasPages())
        <div style="padding:12px 14px;border-top:1px solid #eee">{{ $images->links() }}</div>
    @endif
    <!-- Lightbox -->
    <div id="lightbox"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;align-items:center;justify-content:center;flex-direction:column"
        role="dialog" aria-modal="true">
        <button onclick="closeLightbox()"
            style="position:absolute;top:20px;right:20px;background:transparent;border:none;color:#fff;font-size:32px;cursor:pointer;line-height:1"
            aria-label="Close">&times;</button>
        <img id="lbImg" style="max-width:92vw;max-height:82vh;object-fit:contain" alt="">
        <p id="lbCap" style="color:#fff;margin-top:10px;font-size:14px"></p>
    </div>
@endsection
