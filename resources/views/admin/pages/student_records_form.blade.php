@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-user-graduate"></i>
                {{ isset($student) ? 'শিক্ষার্থী সম্পাদনা' : 'নতুন শিক্ষার্থী যোগ করুন' }}
            </h3>
            <a href="{{ route('admin.student-records.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left">
                </i> ফিরে যান
            </a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($student) ? route('admin.student-records.update', $student) : route('admin.student-records.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($student))
                    @method('PUT')
                @endif

                <div
                    style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:6px;padding:16px;margin-bottom:16px;display:flex;gap:22px;align-items:flex-start">
                    <div style="text-align:center;flex-shrink:0">
                        <img id="photoPreview"
                            src="{{ isset($student) && $student->photo ? asset('storage/' . $student->photo) : '' }}"
                            class="photo-preview"
                            style="{{ isset($student) && $student->photo ? '' : 'display:none;' }}width:100px;height:120px"
                            alt="">
                        <div id="photoPlaceholder"
                            style="{{ isset($student) && $student->photo ? 'display:none;' : '' }}width:100px;height:120px;background:#f0f0f0;border:2px dashed #bdb;display:flex;align-items:center;justify-content:center;font-size:28px;color:#bbb">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="form-group" style="margin-top:8px">
                            <label style="font-size:11px">ছবি</label>
                            <input type="file" name="photo" class="form-control" accept="image/*"
                                data-preview="photoPreview"
                                onchange="document.getElementById('photoPlaceholder').style.display='none'">
                        </div>
                    </div>
                    
                    <div style="flex:1">
                        <div class="form-row">
                            <div class="form-group">
                                <label>রোল নম্বর</label>
                                <input type="text" name="roll_no" class="form-control"
                                    value="{{ old('roll_no', $student->roll_no ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label>একাডেমিক বছর</label>
                                <select name="academic_year" class="form-control">
                                    @foreach (range(date('Y') + 1, date('Y') - 4) as $y)
                                        <option value="{{ $y }}"
                                            {{ old('academic_year', $student->academic_year ?? date('Y')) == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>শ্রেণি *</label>
                                <select name="class" class="form-control" required>
                                    @foreach (['Six', 'Seven', 'Eight', 'Nine', 'Ten'] as $c)
                                        <option value="{{ $c }}"
                                            {{ old('class', $student->class ?? '') === $c ? 'selected' : '' }}>
                                            {{ $c }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>শিফট *</label>
                                <select name="shift" class="form-control" required>
                                    <option value="Day"
                                        {{ old('shift', $student->shift ?? 'Day') === 'Day' ? 'selected' : '' }}>
                                        Day
                                    </option>
                                    <option value="Morning"
                                        {{ old('shift', $student->shift ?? '') === 'Morning' ? 'selected' : '' }}>Morning
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>সেকশন</label><select name="section" class="form-control">
                                    <option value="">নেই</option>
                                    @foreach (['A', 'B', 'C', 'D', 'E'] as $s)
                                        <option value="{{ $s }}"
                                            {{ old('section', $student->section ?? '') === $s ? 'selected' : '' }}>
                                            {{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><label>অবস্থা</label><select name="status" class="form-control">
                                    <option value="active"
                                        {{ old('status', $student->status ?? 'active') === 'active' ? 'selected' : '' }}>
                                        সক্রিয়
                                    </option>

                                    <option value="inactive"
                                        {{ old('status', $student->status ?? '') === 'inactive' ? 'selected' : '' }}>
                                        নিষ্ক্রিয়
                                    </option>

                                    <option value="transferred"
                                        {{ old('status', $student->status ?? '') === 'transferred' ? 'selected' : '' }}>
                                        ট্রান্সফার
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin-bottom:10px;padding-bottom:5px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-user"></i> শিক্ষার্থীর নাম
                </h4>
                <div class="form-row">
                    <div class="form-group"><label>নাম (বাংলায়) *</label>
                        <input type="text" name="name_bn" class="form-control"
                            value="{{ old('name_bn', $student->name_bn ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>নাম (ইংরেজিতে)</label>
                        <input type="text" name="name_en" class="form-control"
                            value="{{ old('name_en', $student->name_en ?? '') }}">
                    </div>
                </div>
                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin:14px 0 10px;padding-bottom:5px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-users"></i> অভিভাবকের তথ্য
                </h4>
                <div class="form-row">
                    <div class="form-group">
                        <label>পিতার নাম</label>
                        <input type="text" name="father_name" class="form-control"
                            value="{{ old('father_name', $student->father_name ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>মাতার নাম</label>
                        <input type="text" name="mother_name" class="form-control"
                            value="{{ old('mother_name', $student->mother_name ?? '') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>পিতার পেশা</label>
                        <input type="text" name="father_occupation" class="form-control"
                            value="{{ old('father_occupation', $student->father_occupation ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>মাসিক আয়</label>
                        <input type="text" name="monthly_income" class="form-control"
                            value="{{ old('monthly_income', $student->monthly_income ?? '') }}" placeholder="Taka 10000">
                    </div>
                </div>

                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin:14px 0 10px;padding-bottom:5px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-id-card"></i> ব্যক্তিগত তথ্য
                </h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>জন্ম তারিখ</label><input type="date" name="dob" class="form-control"
                            value="{{ old('dob', isset($student) ? $student->dob?->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label>লিঙ্গ</label>
                        <select name="gender" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            <option value="male"
                                {{ old('gender', $student->gender ?? '') === 'male' ? 'selected' : '' }}>ছেলে
                            </option>
                            <option value="female"
                                {{ old('gender', $student->gender ?? '') === 'female' ? 'selected' : '' }}>মেয়ে
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group"><label>ধর্ম</label>
                        <select name="religion" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            @foreach (['islam' => 'ইসলাম', 'hindu' => 'হিন্দু', 'buddhist' => 'বৌদ্ধ', 'christian' => 'খ্রিষ্টান', 'other' => 'অন্যান্য'] as $v => $l)
                                <option value="{{ $v }}"
                                    {{ old('religion', $student->religion ?? '') === $v ? 'selected' : '' }}>
                                    {{ $l }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"><label>জন্ম নিবন্ধন নম্বর</label><input type="text" name="birth_cert_no"
                            class="form-control" value="{{ old('birth_cert_no', $student->birth_cert_no ?? '') }}">
                    </div>
                </div>

                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin:14px 0 10px;padding-bottom:5px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-phone"></i> যোগাযোগ
                </h4>

                <div class="form-row">
                    <div class="form-group"><label>মোবাইল নম্বর</label><input type="text" name="mobile"
                            class="form-control" value="{{ old('mobile', $student->mobile ?? '') }}">
                    </div>

                    <div class="form-group"><label>ইমেইল</label><input type="email" name="email"
                            class="form-control" value="{{ old('email', $student->email ?? '') }}">
                    </div>
                </div>

                <div class="form-group"><label>ঠিকানা</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $student->address ?? '') }}</textarea>
                </div>
                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin:14px 0 10px;padding-bottom:5px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-school"></i>
                    পূর্ববর্তী বিদ্যালয়
                </h4>
                <div class="form-row">
                    <div class="form-group"><label>বিদ্যালয়ের নাম</label><input type="text" name="prev_school"
                            class="form-control" value="{{ old('prev_school', $student->prev_school ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>পূর্ববর্তী শ্রেণি</label>
                        <input type="text" name="prev_class" class="form-control"
                            value="{{ old('prev_class', $student->prev_class ?? '') }}" placeholder="যেমন: পঞ্চম">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>GPA / ফলাফল</label><input type="text" name="prev_result"
                            class="form-control" value="{{ old('prev_result', $student->prev_result ?? '') }}"
                            placeholder="GPA 5.00">
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        {{ isset($student) ? 'আপডেট করুন' : 'সংরক্ষণ করুন' }}</button><a
                        href="{{ route('admin.student-records.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a>
                </div>
            </form>
        </div>
    </div>
@endsection
