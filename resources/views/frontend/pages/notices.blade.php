@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">নোটিশ বোর্ড</div>
    <div style="padding:14px">
        @forelse($notices as $n)
            <div style="border-bottom:1px solid #eee;padding:9px 0;display:flex;align-items:flex-start;gap:9px">
                <span style="color:#E53935;font-size:10px;margin-top:4px">➤</span>
                <div><a href="{{ $n->file ? asset('storage/' . $n->file) : '#' }}" {{ $n->file ? 'target=_blank' : '' }}
                        style="color:#1565C0;font-size:13px">{{ $n->title }}</a>
                    <div style="font-size:11px;color:#999;margin-top:2px">{{ $n->created_at->format('d M Y') }}</div>
                </div>
            </div>
        @empty
            <div class="empty-state"><i class="fas fa-bell-slash"></i>
                <p>কোনো নোটিশ নেই।</p>
            </div>
        @endforelse
    </div>
    @if ($notices->hasPages())
        <div style="padding:10px 14px;border-top:1px solid #eee">{{ $notices->links() }}</div>
    @endif
@endsection
