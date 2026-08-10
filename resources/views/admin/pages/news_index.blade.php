@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-newspaper"></i> নোটিশ (টিকার/স্ক্রোল)</h3><a href="{{ route('admin.news.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন খবর</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>শিরোনাম</th>
                        <th>লিংক</th>
                        <th>অবস্থা</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $i=>$item)
                        <tr>
                            <td>{{ $news->firstItem() + $i }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->title, 50) }}</td>
                            <td>{{ $item->link ? 'আছে' : 'নেই' }}</td>
                            <td><span
                                    class="badge badge-{{ $item->is_active ? 'success' : 'danger' }}">{{ $item->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="display:flex;gap:4px"><a href="{{ route('admin.news.edit', $item) }}"
                                        class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="6" style="text-align:center;padding:30px;color:#999">কোনো খবর নেই।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $news->links() }}</div>
    </div>
@endsection
