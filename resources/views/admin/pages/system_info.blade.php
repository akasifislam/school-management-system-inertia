@extends('layouts.admin')
@section('content')
    {{-- ══ TOP METRICS ══ --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px">

        <div
            style="background:#fff;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.1);padding:18px;text-align:center;border-top:4px solid #1565C0">
            <div style="font-size:32px;margin-bottom:4px">🐘</div>
            <div style="font-size:18px;font-weight:700;color:#1565C0">{{ $info['php_version'] }}</div>
            <div style="font-size:11px;color:#888;margin-top:3px">PHP ভার্সন</div>
        </div>
        <div
            style="background:#fff;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.1);padding:18px;text-align:center;border-top:4px solid #7B1FA2">
            <div style="font-size:32px;margin-bottom:4px">⚡</div>
            <div style="font-size:18px;font-weight:700;color:#7B1FA2">{{ $info['laravel_ver'] }}</div>
            <div style="font-size:11px;color:#888;margin-top:3px">Laravel ভার্সন</div>
        </div>
        <div
            style="background:#fff;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.1);padding:18px;text-align:center;border-top:4px solid {{ $info['disk']['percent'] > 80 ? '#E53935' : '#2E7D32' }}">
            <div style="font-size:32px;margin-bottom:4px">💾</div>
            <div style="font-size:18px;font-weight:700;color:{{ $info['disk']['percent'] > 80 ? '#E53935' : '#2E7D32' }}">
                {{ $info['disk']['percent'] }}%</div>
            <div style="font-size:11px;color:#888;margin-top:3px">ডিস্ক ব্যবহার</div>
            <div style="height:4px;background:#eee;border-radius:2px;overflow:hidden;margin-top:8px">
                <div
                    style="height:100%;width:{{ $info['disk']['percent'] }}%;background:{{ $info['disk']['percent'] > 80 ? '#E53935' : '#2E7D32' }};border-radius:2px">
                </div>
            </div>
        </div>
        <div
            style="background:#fff;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,.1);padding:18px;text-align:center;border-top:4px solid #F57F17">
            <div style="font-size:32px;margin-bottom:4px">🗄️</div>
            <div style="font-size:18px;font-weight:700;color:#F57F17">{{ $info['db']['size'] }}</div>
            <div style="font-size:11px;color:#888;margin-top:3px">ডেটাবেস সাইজ</div>
        </div>

    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px">

        {{-- Server Info --}}
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-server"></i> সার্ভার তথ্য</h3>
            </div>
            <table class="admin-table">
                <tbody>
                    @foreach ([['PHP ভার্সন', $info['php_version']], ['Laravel ভার্সন', $info['laravel_ver']], ['সার্ভার সফটওয়্যার', $info['server_software']], ['মেমোরি লিমিট', $info['memory_limit']], ['সর্বোচ্চ আপলোড', $info['max_upload']], ['POST সাইজ', $info['max_post']], ['টাইমজোন', $info['timezone']], ['অ্যাপ পরিবেশ', $info['env']], ['ডিবাগ মোড', $info['debug']], ['সার্ভার আপটাইম', $info['uptime']]] as [$k, $v])
                        <tr>
                            <td style="font-weight:700;color:#546E7A;font-size:12px;width:45%">{{ $k }}</td>
                            <td style="font-size:12px;font-family:monospace;color:#263238">{{ $v }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- DB & Cache --}}
        <div class="admin-card" style="margin-bottom:0">
            <div class="card-header">
                <h3><i class="fas fa-database"></i> ডেটাবেস ও ক্যাশ</h3>
            </div>
            <table class="admin-table">
                <tbody>
                    @foreach ([['DB কানেকশন', $info['db_connection']], ['DB সাইজ', $info['db']['size']], ['ক্যাশ ড্রাইভার', $info['cache_driver']], ['সেশন ড্রাইভার', $info['session_driver']], ['ডিস্ক মোট', $info['disk']['total']], ['ডিস্ক ব্যবহৃত', $info['disk']['used']], ['ডিস্ক খালি', $info['disk']['free']], ['ব্যবহার %', $info['disk']['percent'] . '%']] as [$k, $v])
                        <tr>
                            <td style="font-weight:700;color:#546E7A;font-size:12px;width:45%">{{ $k }}</td>
                            <td style="font-size:12px;font-family:monospace;color:#263238">{{ $v }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body" style="padding-top:0;border-top:1px solid #eef0f4">
                <form action="{{ route('admin.maintenance.cache-clear') }}" method="POST" style="margin-top:12px">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
                        <i class="fas fa-broom"></i> সব ক্যাশ এখনই পরিষ্কার করুন
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- PHP Extensions --}}
    <div class="admin-card" style="margin-bottom:18px">
        <div class="card-header">
            <h3><i class="fas fa-puzzle-piece"></i> PHP এক্সটেনশন</h3>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:8px">
                @foreach (['pdo', 'pdo_mysql', 'mbstring', 'json', 'openssl', 'tokenizer', 'xml', 'ctype', 'fileinfo', 'bcmath', 'gd', 'zip', 'intl', 'curl'] as $ext)
                    @php $loaded = extension_loaded($ext); @endphp
                    <div
                        style="padding:8px 12px;border-radius:4px;background:{{ $loaded ? '#E8F5E9' : '#FFEBEE' }};border:1px solid {{ $loaded ? '#A5D6A7' : '#FFCDD2' }};display:flex;align-items:center;gap:8px;font-size:12px">
                        <span style="font-size:14px">{{ $loaded ? '✅' : '❌' }}</span>
                        <span
                            style="font-weight:600;color:{{ $loaded ? '#2E7D32' : '#C62828' }}">{{ $ext }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- DB Table Sizes --}}
    @if (!empty($info['tables']))
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-table"></i> ডেটাবেস টেবিল সাইজ</h3>
            </div>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>টেবিলের নাম</th>
                            <th>সারি সংখ্যা</th>
                            <th>সাইজ (KB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($info['tables'] as $t)
                            <tr>
                                <td style="font-family:monospace;font-size:12px">{{ $t->table_name }}</td>
                                <td style="text-align:center">{{ number_format($t->table_rows) }}</td>
                                <td style="text-align:center">
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <span>{{ $t->size_kb }}</span>
                                        <div
                                            style="flex:1;height:4px;background:#eee;border-radius:2px;overflow:hidden;max-width:100px">
                                            <div
                                                style="height:100%;width:{{ min(100, ($t->size_kb / max(1, collect($info['tables'])->max('size_kb'))) * 100) }}%;background:#1565C0;border-radius:2px">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
