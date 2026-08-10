@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-poll"></i> পরীক্ষার ফলাফল</h3><a href="{{ route('admin.results.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন ফলাফল</a>
        </div>
        <div class="filter-bar">
            <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="খুঁজুন..." style="max-width:200px">
                <select name="year" class="form-control" style="max-width:120px">
                    <option value="">সব বছর</option>
                    @foreach ($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
                <select name="exam_type" class="form-control" style="max-width:140px">
                    <option value="">সব ধরন</option>
                    @foreach (['JSC', 'SSC', 'Half_Yearly', 'Annual', 'Admission'] as $t)
                        <option value="{{ $t }}" {{ request('exam_type') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>শিরোনাম</th>
                        <th>পরীক্ষা</th>
                        <th>বছর</th>
                        <th>ফাইল</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $i=>$r)
                        <tr>
                            <td>{{ $results->firstItem() + $i }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($r->title, 40) }}</td>
                            <td><span class="badge badge-info">{{ $r->exam_type }}</span></td>
                            <td>{{ $r->year }}</td>
                            <td><a href="{{ asset('storage/' . $r->file) }}" target="_blank" class="btn btn-icon"><i
                                        class="fas fa-eye" style="color:#1565C0"></i></a></td>
                            <td>{{ $r->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="display:flex;gap:4px"><a href="{{ route('admin.results.edit', $r) }}"
                                        class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.results.destroy', $r) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="7" style="text-align:center;padding:30px;color:#999">কোনো ফলাফল নেই।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $results->links() }}</div>
    </div>
@endsection
