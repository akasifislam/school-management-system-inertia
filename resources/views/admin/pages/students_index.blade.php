@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-chart-bar"></i> শিক্ষার্থীর সংখ্যা ব্যবস্থাপনা</h3><a
                href="{{ route('admin.students.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন
                রেকর্ড</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>শ্রেণি</th>
                        <th>শিফট</th>
                        <th>সেকশন</th>
                        <th>ছেলে</th>
                        <th>মেয়ে</th>
                        <th>মোট</th>
                        <th>মুসলিম</th>
                        <th>হিন্দু</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studentData as $r)
                        <tr>
                            <td>{{ $r->class }}</td>
                            <td>{{ $r->shift }}</td>
                            <td>{{ $r->section ?? '—' }}</td>
                            <td>{{ $r->boys }}</td>
                            <td>{{ $r->girls }}</td>
                            <td><strong>{{ $r->total }}</strong></td>
                            <td>{{ $r->muslim }}</td>
                            <td>{{ $r->hindu }}</td>
                            <td>
                                <div style="display:flex;gap:4px"><a href="{{ route('admin.students.edit', $r) }}"
                                        class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.students.destroy', $r) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="9">
                                <div class="empty-state"><i class="fas fa-chart-bar"></i>
                                    <h3>কোনো রেকর্ড নেই</h3><a href="{{ route('admin.students.create') }}"
                                        class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> রেকর্ড
                                        যোগ করুন</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $studentData->links() }}</div>
    </div>
@endsection
