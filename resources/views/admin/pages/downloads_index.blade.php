@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-download"></i> ডাউনলোডস</h3><a href="{{ route('admin.downloads.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন ফাইল</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>শিরোনাম</th>
                        <th>বিভাগ</th>
                        <th>ফাইল</th>
                        <th>অবস্থা</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downloads as $i=>$d)
                        <tr>
                            <td>{{ $downloads->firstItem() + $i }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($d->title, 40) }}</td>
                            <td>{{ $d->category ?? '-' }}</td>
                            <td><a href="{{ asset('storage/' . $d->file) }}" target="_blank" class="btn btn-icon"><i
                                        class="fas fa-eye" style="color:#1565C0"></i></a></td>
                            <td><span
                                    class="badge badge-{{ $d->is_active ? 'success' : 'danger' }}">{{ $d->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            <td>{{ $d->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="display:flex;gap:4px"><a href="{{ route('admin.downloads.edit', $d) }}"
                                        class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.downloads.destroy', $d) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="7">
                                <div class="empty-state"><i class="fas fa-folder-open"></i>
                                    <h3>কোনো ফাইল নেই</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $downloads->links() }}</div>
    </div>
@endsection
