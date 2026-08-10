@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">ডাউনলোডস</div>
    <div style="padding:14px">
        @forelse($downloads as $d)
            <div style="border-bottom:1px solid #eee;padding:9px 0;display:flex;align-items:center;gap:10px">
                <i class="fas fa-file-pdf" style="color:#E53935;font-size:18px;flex-shrink:0"></i>
                <div style="flex:1"><a href="{{ asset('storage/' . $d->file) }}" target="_blank"
                        style="color:#1565C0;font-size:13px">{{ $d->title }}</a>
                    <div style="font-size:11px;color:#999;margin-top:2px">{{ $d->created_at->format('d M Y') }}</div>
                </div>
                <a href="{{ asset('storage/' . $d->file) }}" target="_blank" class="btn btn-primary btn-sm"><i
                        class="fas fa-download"></i></a>
            </div>
        @empty
            <div class="empty-state"><i class="fas fa-folder-open"></i>
                <p>কোনো ডাউনলোড নেই।</p>
            </div>
        @endforelse
    </div>
    @if ($downloads->hasPages())
        <div style="padding:10px 14px;border-top:1px solid #eee">{{ $downloads->links() }}</div>
    @endif
@endsection
