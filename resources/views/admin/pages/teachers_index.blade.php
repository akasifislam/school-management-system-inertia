@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-chalkboard-teacher"></i> শিক্ষক তালিকা</h3><a href="{{ route('admin.teachers.create') }}"
                class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন শিক্ষক</a>
        </div>
        <div class="filter-bar">
            <form method="GET" style="display:flex;gap:8px"><input type="text" name="search"
                    value="{{ request('search') }}" class="form-control" placeholder="নাম বা পিডিএস আইডি..."
                    style="max-width:280px"><button type="submit" class="btn btn-primary btn-sm"><i
                        class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ছবি</th>
                        <th>পিডিএস আইডি</th>
                        <th>নাম</th>
                        <th>বর্তমান পদবী</th>
                        <th>মোবাইল</th>
                        <th>জেলা</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $i=>$t)
                        <tr>
                            <td>{{ $teachers->firstItem() + $i }}</td>
                            <td>
                                @if ($t->photo)
                                    <img src="{{ asset('storage/' . $t->photo) }}" class="teacher-thumb" alt="">
                                @else
                                    <div
                                        style="width:44px;height:50px;background:#f0f0f0;display:flex;align-items:center;justify-content:center">
                                        <i class="fas fa-user" style="color:#bbb"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-size:12px;color:#888">{{ $t->pds_id }}</td>
                            <td><strong>{{ $t->name }}</strong>
                                <div style="font-size:12px;color:#888">{{ $t->base_designation }}</div>
                            </td>
                            <td>{{ $t->current_designation }}</td>
                            <td>{{ $t->phone }}</td>
                            <td>{{ $t->district }}</td>
                            <td>
                                <div style="display:flex;gap:4px"><a href="{{ route('admin.teachers.edit', $t) }}"
                                        class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.teachers.destroy', $t) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="8">
                                <div class="empty-state"><i class="fas fa-chalkboard-teacher"></i>
                                    <h3>কোনো শিক্ষক নেই</h3><a href="{{ route('admin.teachers.create') }}"
                                        class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> শিক্ষক
                                        যোগ করুন</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $teachers->links() }}</div>
    </div>
@endsection
