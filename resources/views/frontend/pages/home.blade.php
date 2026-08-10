@extends('layouts.frontend')
@section('content')
    @if ($bannerNotice)
        <div class="hero-block">
            <div class="hero-img">
                @if ($bannerNotice->file && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $bannerNotice->file))
                    <img src="{{ asset('storage/' . $bannerNotice->file) }}" alt="{{ $bannerNotice->title }}" loading="eager">
                @else
                    <img src="http://www.govlabcomilla.edu.bd/images/golden_jubilee.png" alt="জাতীয় স্মৃতিসৌধ" loading="lazy"
                        onerror="this.parentElement.style.background='linear-gradient(135deg,#1A6DB5,#0097B2)'">
                @endif
            </div>
            <div class="hero-body">
                <h2>{{ $bannerNotice->title }}</h2>
                @if ($bannerNotice->file)
                    <a href="{{ asset('storage/' . $bannerNotice->file) }}" target="_blank"
                        class="hero-link">{{ $bannerNotice->description ?? 'সুবর্ণজয়ন্তী ছবির গ্যালারী' }}</a>
                @endif
                <div class="hero-footer">
                    <a href="{{ route('notices') }}" class="btn-all">সকল</a>
                </div>
            </div>
        </div>
    @endif

    <div class="sec-block">
        <div class="sec-inner">
            <div class="sec-icon-col">
                <div class="icon-notepad-fa">
                    <span style="font-size:26px;line-height:1">📋</span>
                </div>
            </div <div class="sec-body">
            <div class="sec-title">নোটিশ বোর্ড</div>
            @if ($notices->count())
                <ul class="notice-list">
                    @foreach ($notices as $notice)
                        <li>
                            @if ($notice->file)
                                <a href="{{ asset('storage/' . $notice->file) }}" target="_blank"
                                    rel="noopener">{{ $notice->title }}</a>
                            @else
                                <span>{{ $notice->title }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p style="color:#888;font-size:12.5px;padding:4px 0">কোনো নোটিশ নেই।</p>
            @endif
        </div>

    </div>
    <div class="sec-footer">
        <a href="{{ route('notices') }}" class="btn-all">সকল</a>
    </div>
    </div>

    {{-- ══════════════════════════════════════════
     NEWS TICKER ROW — "খবর : ► ... | সকল"
     Exactly matching screenshot
     ══════════════════════════════════════════ --}}
    <div class="ticker-row">
        <span class="ticker-lbl">খবর :</span>
        <span class="ticker-sep">›</span>
        <div class="ticker-content">
            @if ($newsItems->count())
                <span class="ticker-scroll" aria-live="polite">
                    @foreach ($newsItems as $ni)
                        @if ($ni->link)
                            <a href="{{ $ni->link }}" target="_blank"
                                rel="noopener">&nbsp;&nbsp;{{ $ni->title }}</a>
                        @else
                            &nbsp;&nbsp;{{ $ni->title }}
                        @endif
                        &nbsp;&nbsp;|
                    @endforeach
                </span>
            @else
                <span style="color:#888;font-size:12.5px">কোনো খবর নেই।</span>
            @endif
        </div>
        <div class="ticker-btns">
            <a href="{{ route('notices') }}" class="btn-next">সকল</a>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
     DOWNLOADS — Cyan circle icon + list
     Exactly matching screenshot
     ══════════════════════════════════════════ --}}
    <div class="sec-block">
        <div class="sec-inner">

            {{-- Cyan download circle icon --}}
            <div class="sec-icon-col">
                <div class="icon-dl-circle">
                    <i class="fas fa-download"></i>
                </div>
            </div>

            {{-- Downloads list --}}
            <div class="sec-body">
                <div class="sec-title">ডাউনলোডস</div>
                @if ($downloads->count())
                    <ul class="dl-list">
                        @foreach ($downloads as $dl)
                            <li>
                                <a href="{{ asset('storage/' . $dl->file) }}" target="_blank"
                                    rel="noopener">{{ $dl->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p style="color:#888;font-size:12.5px;padding:4px 0">কোনো ডাউনলোড নেই।</p>
                @endif
            </div>

        </div>
        <div class="sec-footer">
            <a href="{{ route('downloads') }}" class="btn-all">সকল</a>
        </div>
    </div>

@endsection
