@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-list-alt"></i> অ্যাক্টিভিটি লগ</h3>
            <div style="display:flex;gap:8px">
                <form action="{{ route('admin.activity-logs.clear') }}" method="POST" style="display:inline">
                    @csrf
                    <select name="days" class="form-control"
                        style="padding:5px 10px;font-size:12px;display:inline;width:auto">
                        <option value="7">৭ দিনের পুরোনো</option>
                        <option value="30" selected>৩০ দিনের পুরোনো</option>
                        <option value="90">৯০ দিনের পুরোনো</option>
                    </select>
                    <button type="submit" class="btn btn-danger btn-sm" data-confirm="পুরোনো লগ মুছতে চান?">
                        <i class="fas fa-trash"></i> লগ মুছুন
                    </button>
                </form>
            </div>
        </div>

        <div class="filter-bar">
            <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
                <input type="text" name="user" value="{{ request('user') }}" class="form-control"
                    placeholder="ব্যবহারকারীর নাম..." style="max-width:180px">
                <select name="action" class="form-control" style="max-width:180px">
                    <option value="">সব অ্যাকশন</option>
                    @foreach ($actions as $a)
                        <option value="{{ $a }}" {{ request('action') === $a ? 'selected' : '' }}>
                            {{ $a }}
                        </option>
                    @endforeach
                </select>
                <input type="date" name="date" value="{{ request('date') }}" class="form-control"
                    style="max-width:160px">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                <a href="{{ route('admin.activity-logs') }}" class="btn btn-sm"
                    style="background:#f5f7fa;border:1px solid #dde1e9">রিসেট</a>
            </form>
            <span class="ms-auto" style="font-size:12px;color:#888">মোট: <strong>{{ $logs->total() }}</strong></span>
        </div>

        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ব্যবহারকারী</th>
                        <th>আইপি</th>
                        <th>অ্যাকশন</th>
                        <th>বিবরণ</th>
                        <th>তারিখ ও সময়</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $i => $log)
                        @php
                            $icons = [
                                'login' => ['🔑', 'badge-info'],
                                'logout' => ['🚪', 'badge-info'],
                                'maintenance_on' => ['⚠️', 'badge-warning'],
                                'maintenance_off' => ['✅', 'badge-success'],
                                'backup_created' => ['💾', 'badge-success'],
                                'cache_cleared' => ['🧹', 'badge-info'],
                                'announcement_created' => ['📢', 'badge-info'],
                                'site_controls_updated' => ['⚙️', 'badge-info'],
                            ];
                            [$icon, $badge] = $icons[$log->action] ?? ['📝', 'badge-info'];
                        @endphp
                        <tr>
                            <td>{{ $logs->firstItem() + $i }}</td>
                            <td>
                                <div style="font-weight:600;font-size:13px">{{ $log->user_name ?? 'System' }}</div>
                                <div style="font-size:11px;color:#888">ID: {{ $log->user_id ?? '-' }}</div>
                            </td>
                            <td style="font-size:12px;color:#888;font-family:monospace">{{ $log->ip_address ?? '-' }}</td>
                            <td><span class="badge {{ $badge }}">{{ $icon }} {{ $log->action }}</span>
                            </td>
                            <td style="font-size:12.5px">{{ $log->description }}</td>
                            <td style="font-size:12px;white-space:nowrap">
                                <div>{{ $log->created_at->format('d/m/Y') }}</div>
                                <div style="color:#888">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state"><i class="fas fa-list-alt"></i>
                                    <h3>কোনো লগ নেই</h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $logs->links() }}</div>
    </div>
@endsection
