@extends('layouts.admin')
@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
            <div>
                <div class="stat-value">{{ $stats['students'] }}</div>
                <div class="stat-label">মোট শিক্ষার্থী</div>
            </div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div>
                <div class="stat-value">{{ $stats['teachers'] }}</div>
                <div class="stat-label">শিক্ষক-শিক্ষিকা</div>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon"><i class="fas fa-bell"></i></div>
            <div>
                <div class="stat-value">{{ $stats['notices'] }}</div>
                <div class="stat-label">সক্রিয় নোটিশ</div>
            </div>
        </div>
        <div class="stat-card warn">
            <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
            <div>
                <div class="stat-value">{{ $stats['admissions'] }}</div>
                <div class="stat-label">অপেক্ষমান আবেদন</div>
            </div>
        </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-bell"></i> সাম্প্রতিক নোটিশ</h3><a href="{{ route('admin.notices.index') }}"
                    class="btn btn-sm btn-primary">সব দেখুন</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>শিরোনাম</th>
                            <th>তারিখ</th>
                            <th>অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNotices as $n)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($n->title, 38) }}</td>
                                <td>{{ $n->created_at->format('d/m/Y') }}</td>
                                <td><span
                                        class="badge badge-{{ $n->is_active ? 'success' : 'danger' }}">{{ $n->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                                </td>
                            </tr>
                        @empty<tr>
                                <td colspan="3" style="text-align:center;color:#999;padding:20px">কোনো নোটিশ নেই।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-file-alt"></i> সাম্প্রতিক ভর্তি আবেদন</h3><a
                    href="{{ route('admin.admissions.index') }}" class="btn btn-sm btn-primary">সব দেখুন</a>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>নাম</th>
                            <th>শ্রেণি</th>
                            <th>তারিখ</th>
                            <th>অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAdmissions as $a)
                            <tr>
                                <td>{{ $a->name_bn }}</td>
                                <td>{{ $a->applying_class }}</td>
                                <td>{{ $a->created_at->format('d/m/Y') }}</td>
                                <td><span
                                        class="badge badge-{{ $a->status === 'approved' ? 'success' : ($a->status === 'rejected' ? 'danger' : 'warning') }}">{{ $a->status === 'approved' ? 'অনুমোদিত' : ($a->status === 'rejected' ? 'বাতিল' : 'অপেক্ষমান') }}</span>
                                </td>
                            </tr>
                        @empty<tr>
                                <td colspan="4" style="text-align:center;color:#999;padding:20px">কোনো আবেদন নেই।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
