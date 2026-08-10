@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-bullhorn"></i> ঘোষণা / Popup ম্যানেজমেন্ট</h3>
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> নতুন
                ঘোষণা
            </a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>শিরোনাম</th>
                        <th>ধরন</th>
                        <th>Popup</th>
                        <th>Banner</th>
                        <th>মেয়াদ</th>
                        <th>অবস্থা</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $i => $ann)
                        @php $colors=['info'=>'badge-info','success'=>'badge-success','warning'=>'badge-warning','danger'=>'badge-danger']; @endphp
                        <tr>
                            <td>{{ $announcements->firstItem() + $i }}</td>
                            <td>
                                <div style="font-weight:700">{{ $ann->title }}</div>
                                <div style="font-size:12px;color:#888">
                                    {{ \Illuminate\Support\Str::limit($ann->message, 50) }}
                                </div>
                            </td>
                            <td><span class="badge {{ $colors[$ann->type] ?? 'badge-info' }}">{{ $ann->type }}</span>
                            </td>
                            <td style="text-align:center">{{ $ann->show_popup ? '✅' : '-' }}</td>
                            <td style="text-align:center">{{ $ann->show_banner ? '✅' : '-' }}</td>
                            <td style="font-size:12px">
                                @if ($ann->start_date || $ann->end_date)
                                    {{ $ann->start_date?->format('d/m/Y') ?? '—' }} →
                                    {{ $ann->end_date?->format('d/m/Y') ?? '—' }}
                                @else
                                    <span style="color:#888">সীমাহীন</span>
                                @endif
                            </td>
                            <td><span
                                    class="badge badge-{{ $ann->is_active ? 'success' : 'danger' }}">{{ $ann->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            <td>
                                <div style="display:flex;gap:4px">
                                    <a href="{{ route('admin.announcements.edit', $ann) }}" class="btn btn-icon edit"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.announcements.destroy', $ann) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state"><i class="fas fa-bullhorn"></i>
                                    <h3>কোনো ঘোষণা নেই</h3>
                                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary"
                                        style="margin-top:12px"><i class="fas fa-plus"></i> ঘোষণা যোগ করুন</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $announcements->links() }}</div>
    </div>
@endsection
