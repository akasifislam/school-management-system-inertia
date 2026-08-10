@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-user-graduate"></i>
                শিক্ষার্থীর তালিকা (ব্যক্তিগত রেকর্ড)
            </h3>
            <div style="display:flex;gap:8px"><a href="{{ route('admin.student-records.export') }}"
                    class="btn btn-success btn-sm"><i class="fas fa-file-csv"></i> CSV</a><a
                    href="{{ route('admin.student-records.create') }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-plus"></i> নতুন শিক্ষার্থী</a></div>
        </div>
        <div class="filter-bar">
            <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="নাম / রোল / মোবাইল..." style="max-width:200px">
                <select name="class" class="form-control" style="max-width:120px">
                    <option value="">সব শ্রেণি</option>
                    @foreach (['Six', 'Seven', 'Eight', 'Nine', 'Ten'] as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>
                            {{ $c }}
                        </option>
                    @endforeach
                </select>
                <select name="shift" class="form-control" style="max-width:110px">
                    <option value="">সব শিফট</option>
                    <option value="Day" {{ request('shift') == 'Day' ? 'selected' : '' }}>Day</option>
                    <option value="Morning" {{ request('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                </select>
                <select name="section" class="form-control" style="max-width:100px">
                    <option value="">সব সেকশন</option>
                    @foreach (['A', 'B', 'C', 'D', 'E'] as $s)
                        <option value="{{ $s }}" {{ request('section') == $s ? 'selected' : '' }}>
                            {{ $s }}
                        </option>
                    @endforeach
                </select>
                <select name="status" class="form-control" style="max-width:125px">
                    <option value="">সব অবস্থা</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                    <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>ট্রান্সফার
                    </option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                <a href="{{ route('admin.student-records.index') }}" class="btn btn-sm"
                    style="background:#f5f7fa;border:1px solid #dde1e9">রিসেট</a>
            </form>
            <span class="ms-auto" style="font-size:12px;color:#888">মোট: <strong>{{ $students->total() }}</strong></span>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ছবি</th>
                        <th>রোল</th>
                        <th>নাম</th>
                        <th>শ্রেণি/শিফট/সেকশন</th>
                        <th>মোবাইল</th>
                        <th>অবস্থা</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i=>$s)
                        <tr>
                            <td>{{ $students->firstItem() + $i }}</td>
                            <td>
                                @if ($s->photo)
                                    <img src="{{ asset('storage/' . $s->photo) }}"
                                        style="width:38px;height:44px;object-fit:cover;border:1px solid #ddd"
                                    alt="">@else<div
                                        style="width:38px;height:44px;background:#f0f0f0;display:flex;align-items:center;justify-content:center">
                                        <i class="fas fa-user" style="color:#bbb"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-size:12px">{{ $s->roll_no ?? '—' }}</td>
                            <td><strong>{{ $s->name_bn }}</strong>
                                <div style="font-size:12px;color:#888">{{ $s->name_en }}</div>
                            </td>
                            <td style="text-align:center;font-size:12px"><strong>{{ $s->class }}</strong> /
                                {{ $s->shift }} / {{ $s->section ?? '—' }}</td>
                            <td style="font-size:12px">{{ $s->mobile ?? '—' }}</td>
                            <td>
                                <form action="{{ route('admin.student-records.status', $s) }}" method="POST">@csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control"
                                        style="padding:3px 6px;font-size:11px;min-width:95px" onchange="this.form.submit()">
                                        <option value="active" {{ $s->status == 'active' ? 'selected' : '' }}>✅ সক্রিয়
                                        </option>
                                        <option value="inactive" {{ $s->status == 'inactive' ? 'selected' : '' }}>❌
                                            নিষ্ক্রিয়
                                        </option>
                                        <option value="transferred" {{ $s->status == 'transferred' ? 'selected' : '' }}>🔄
                                            ট্রান্সফার</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div style="display:flex;gap:4px">
                                    <a href="{{ route('admin.student-records.edit', $s) }}" class="btn btn-icon edit"
                                        title="সম্পাদনা"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-icon" title="ট্রান্সফার"
                                        style="color:#F57F17;border-color:#F57F17"
                                        onclick="openTransfer({{ $s->id }},'{{ addslashes($s->name_bn) }}','{{ $s->class }}','{{ $s->shift }}','{{ $s->section }}')"><i
                                            class="fas fa-exchange-alt"></i></button>
                                    <form action="{{ route('admin.student-records.destroy', $s) }}" method="POST">@csrf
                                        @method('DELETE')<button type="submit" class="btn btn-icon delete"
                                            data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr>
                            <td colspan="8">
                                <div class="empty-state"><i class="fas fa-user-graduate"></i>
                                    <h3>কোনো শিক্ষার্থী নেই</h3><a href="{{ route('admin.student-records.create') }}"
                                        class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> যোগ
                                        করুন</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">{{ $students->links() }}</div>
    </div>

    <!-- Transfer Modal -->
    <div id="transferModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center">
        <div
            style="background:#fff;border-radius:8px;padding:26px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.3)">
            <h3 style="font-size:15px;font-weight:700;margin-bottom:4px;color:#1565C0"><i class="fas fa-exchange-alt"></i>
                শ্রেণি ট্রান্সফার</h3>
            <p id="transferStudentName" style="font-size:13px;color:#546E7A;margin-bottom:16px"></p>
            <form id="transferForm" method="POST">@csrf @method('PATCH')
                <div class="form-row">
                    <div class="form-group"><label>নতুন শ্রেণি *</label><select name="class" id="tf_class"
                            class="form-control" required>
                            @foreach (['Six', 'Seven', 'Eight', 'Nine', 'Ten'] as $c)
                                <option value="{{ $c }}">{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"><label>শিফট *</label><select name="shift" id="tf_shift"
                            class="form-control" required>
                            <option value="Day">Day</option>
                            <option value="Morning">Morning</option>
                        </select></div>
                </div>
                <div class="form-group"><label>সেকশন</label><select name="section" id="tf_section" class="form-control">
                        <option value="">নেই</option>
                        @foreach (['A', 'B', 'C', 'D', 'E'] as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>নোট</label>
                    <textarea name="transfer_note" class="form-control" rows="2"></textarea>
                </div>
                <div style="display:flex;gap:10px"><button type="submit" class="btn btn-primary"><i
                            class="fas fa-check"></i> ট্রান্সফার</button><button type="button" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9" onclick="closeTransfer()">বাতিল</button></div>
            </form>
        </div>
    </div>
@endsection
