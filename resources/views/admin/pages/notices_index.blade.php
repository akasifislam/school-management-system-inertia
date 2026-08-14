@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-bell"></i> নোটিশ বোর্ড</h3><a href="{{ route('admin.notices.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন নোটিশ</a>
        </div>
        <div class="filter-bar">
            <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="অনুসন্ধান..." style="max-width:230px">
                <select name="status" class="form-control" style="max-width:140px">
                    <option value="">সব অবস্থা</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>সক্রিয়</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>নং</th>
                        <th>শিরোনাম</th>
                        <th>ফাইল</th>
                        <th>ব্যানার</th>
                        <th>অবস্থা</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notices as $i=>$n)
                        <tr>
                            <td>{{ $notices->firstItem() + $i }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($n->title, 45) }}</td>
                            <td>
                                @if ($n->file)
                                    <a href="{{ asset('storage/' . $n->file) }}" target="_blank" class="btn btn-icon">
                                        <i class="fas fa-eye" style="color:#1565C0"></i>
                                    </a>
                                @else
                                    <span style="color:#bbb;font-size:12px">নেই</span>
                                @endif
                            </td>
                            <td>
                                @if ($n->is_banner)
                                    <span class="badge badge-info">হ্যাঁ</span>
                                @endif
                            </td>
                            <td><span
                                    class="badge badge-{{ $n->is_active ? 'success' : 'danger' }}">{{ $n->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            <td>{{ $n->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="display:flex;gap:4px">
                                    <a href="{{ route('admin.notices.edit', $n) }}" class="btn btn-icon edit"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.notices.destroy', $n) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="এই নোটিশটি মুছতে চান?"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="7">
                                <div class="empty-state"><i class="fas fa-bell-slash"></i>
                                    <h3>কোনো নোটিশ নেই</h3><a href="{{ route('admin.notices.create') }}"
                                        class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> নোটিশ
                                        যোগ করুন</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $notices->links() }}</div>
    </div>
@endsection
