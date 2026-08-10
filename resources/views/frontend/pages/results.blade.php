@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">
        পরীক্ষার ফলাফল</div>
    <div class="result-tabs">
        @php $types=['সব'=>'','JSC'=>'JSC','SSC'=>'SSC','অর্ধ-বার্ষিক'=>'Half_Yearly','বার্ষিক'=>'Annual','ভর্তি'=>'Admission']; @endphp
        @foreach ($types as $label => $val)
            <a href="{{ route('results', array_merge(request()->only(['year', 'search']), ['exam_type' => $val])) }}"
                class="result-tab {{ request('exam_type') === $val ? 'active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>
    <div class="result-filter">
        <form method="GET">
            @if (request('exam_type'))
                <input type="hidden" name="exam_type" value="{{ request('exam_type') }}">
            @endif
            <div><label class="form-group">বছর</label><select name="year" class="form-ctrl">
                    <option value="">সব বছর</option>
                    @foreach ($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div><label class="form-group">অনুসন্ধান</label><input type="text" name="search"
                    value="{{ request('search') }}" class="form-ctrl" placeholder="ফলাফলের শিরোনাম..."></div>
            <div style="display:flex;gap:6px;align-items:flex-end"><button type="submit" class="btn btn-primary btn-sm"><i
                        class="fas fa-search"></i></button><a href="{{ route('results') }}" class="btn btn-sm"
                    style="background:#f5f5f5;border:1px solid #ddd;color:#555">রিসেট</a></div>
        </form>
    </div>
    <div style="padding:14px">
        @forelse($results as $r)
            <div class="result-card">
                <div style="flex:1">
                    <div class="result-card-title">{{ $r->title }}</div>
                    <div class="result-card-meta"><span class="exam-badge">{{ $r->exam_type }}</span><span><i
                                class="fas fa-calendar-alt"
                                style="color:#1565C0;margin-right:3px"></i>{{ $r->year }}</span>
                        @if ($r->description)
                            <span>{{ \Illuminate\Support\Str::limit($r->description, 60) }}</span>
                        @endif
                    </div>
                </div>
                <div style="display:flex;gap:6px;flex-shrink:0">
                    <a href="{{ asset('storage/' . $r->file) }}" target="_blank"
                        style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:#E3F2FD;color:#1565C0;border-radius:4px;font-size:12px;font-weight:700;border:1px solid #90CAF9"><i
                            class="fas fa-eye"></i> দেখুন</a>
                    <a href="{{ asset('storage/' . $r->file) }}" download
                        style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:#1565C0;color:#fff;border-radius:4px;font-size:12px;font-weight:700"><i
                            class="fas fa-download"></i> ডাউনলোড</a>
                </div>
            </div>
        @empty
            <div class="empty-state"><i class="fas fa-inbox"></i>
                <h3>কোনো ফলাফল পাওয়া যায়নি।</h3><a href="{{ route('results') }}" style="color:#1565C0;font-size:13px">সব
                    ফলাফল দেখুন</a>
            </div>
        @endforelse
    </div>
    @if ($results->hasPages())
        <div style="padding:10px 14px;border-top:1px solid #eee;display:flex;justify-content:center">
            {{ $results->appends(request()->all())->links() }}</div>
    @endif
@endsection
