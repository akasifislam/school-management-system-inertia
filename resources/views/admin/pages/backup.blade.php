@extends('layouts.admin')
@section('content')
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px">

        {{-- Create Backup --}}
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-database"></i> নতুন ব্যাকআপ তৈরি করুন</h3>
            </div>
            <div class="card-body">
                <div
                    style="background:#E3F2FD;border:1px solid #90CAF9;border-radius:6px;padding:12px;font-size:12.5px;color:#0D47A1;margin-bottom:16px">
                    <i class="fas fa-info-circle"></i>
                    ব্যাকআপে ডেটাবেসের সব টেবিলের ডেটা সংরক্ষিত হবে। নিয়মিত ব্যাকআপ নেওয়া নিরাপদ।
                </div>
                <form action="{{ route('admin.backup.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        style="width:100%;justify-content:center;padding:12px;font-size:14px">
                        <i class="fas fa-download"></i> এখনই ব্যাকআপ তৈরি করুন
                    </button>
                </form>
                <div style="margin-top:12px;font-size:11.5px;color:#888">
                    <p>📁 ব্যাকআপ সংরক্ষিত হয়: <code>storage/app/backups/</code></p>
                    <p style="margin-top:4px">⏰ সর্বশেষ: {{ $backups->first()['date'] ?? 'কোনো ব্যাকআপ নেই' }}</p>
                </div>
            </div>
        </div>

        {{-- Backup Stats --}}
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-chart-pie"></i> ব্যাকআপ পরিসংখ্যান</h3>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div style="text-align:center;background:#f8f9fa;border-radius:6px;padding:14px">
                        <div style="font-size:28px;font-weight:700;color:#1565C0">{{ $backups->count() }}</div>
                        <div style="font-size:12px;color:#888;margin-top:4px">মোট ব্যাকআপ</div>
                    </div>
                    <div style="text-align:center;background:#f8f9fa;border-radius:6px;padding:14px">
                        <div style="font-size:22px;font-weight:700;color:#2E7D32">{{ $backups->first()['size'] ?? '0 B' }}
                        </div>
                        <div style="font-size:12px;color:#888;margin-top:4px">সর্বশেষ সাইজ</div>
                    </div>
                </div>
                <div
                    style="margin-top:14px;padding:10px;background:#FFF8E1;border:1px solid #FFE082;border-radius:6px;font-size:12px;color:#E65100">
                    <i class="fas fa-lightbulb"></i>
                    <strong>পরামর্শ:</strong> সপ্তাহে অন্তত একবার ব্যাকআপ নিন এবং পুরোনো ব্যাকআপ মুছুন।
                </div>
            </div>
        </div>
    </div>

    {{-- Backup List --}}
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-folder-open"></i> ব্যাকআপ তালিকা</h3>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ফাইলের নাম</th>
                        <th>সাইজ</th>
                        <th>তারিখ</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($backups as $i => $backup)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div style="font-family:monospace;font-size:12px">{{ $backup['name'] }}</div>
                                <div style="font-size:11px;color:#888">
                                    {{ str_ends_with($backup['name'], '.sql') ? 'SQL ডাম্প' : 'JSON ডেটা' }}</div>
                            </td>
                            <td style="font-weight:600;color:#1565C0">{{ $backup['size'] }}</td>
                            <td style="font-size:12px">{{ $backup['date'] }}</td>
                            <td>
                                <div style="display:flex;gap:5px">
                                    <a href="{{ route('admin.backup.download', $backup['name']) }}" class="btn btn-icon"
                                        title="ডাউনলোড" style="color:#2E7D32;border-color:#2E7D32">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('admin.backup.delete', $backup['name']) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-icon delete"
                                            data-confirm="এই ব্যাকআপ মুছতে চান?" title="মুছুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state"><i class="fas fa-database"></i>
                                    <h3>কোনো ব্যাকআপ নেই</h3>
                                    <p>উপরে "এখনই ব্যাকআপ তৈরি করুন" বাটনে ক্লিক করুন।</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
