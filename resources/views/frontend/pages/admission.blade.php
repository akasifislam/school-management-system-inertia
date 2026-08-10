@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">
        ভর্তি পরীক্ষার আবেদন</div>

    @if (session('success'))
        <div class="alert-box alert-success" style="margin:14px">
            <i class="fas fa-check-circle" style="font-size:18px"></i>
            <div><strong>আবেদন সফল!</strong><br>{{ session('success') }}</div>
        </div>
    @endif

    <div class="alert-box alert-info" style="margin:0 14px 14px">
        <i class="fas fa-info-circle"></i>
        সকল তারকা (<span style="color:red">*</span>) চিহ্নিত তথ্য পূরণ করা বাধ্যতামূলক।
    </div>

    <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data" class="adm-section">
        @csrf

        {{-- Photo + Name --}}
        <div class="adm-block">
            <div class="adm-block-title"><i class="fas fa-user-graduate"></i> শিক্ষার্থীর তথ্য</div>
            <div style="display:flex;gap:18px;align-items:flex-start">
                <div style="flex-shrink:0;text-align:center">
                    <div class="photo-upload-box" id="photoBox">
                        <img id="photoImg" style="display:none;width:100%;height:100%;object-fit:cover" alt="">
                        <div id="photoPlaceholder" style="text-align:center;color:#bbb;padding:12px">
                            <i class="fas fa-camera" style="font-size:26px;display:block;margin-bottom:6px"></i>
                            <span style="font-size:11px">ছবি</span>
                        </div>
                    </div>
                    <label
                        style="font-size:11px;color:#1565C0;cursor:pointer;text-decoration:underline;display:block;margin-top:5px">
                        ছবি নির্বাচন
                        <input type="file" name="photo" accept="image/*" style="display:none"
                            onchange="previewPhoto(this,'photoImg','photoPlaceholder')">
                    </label>
                    <p style="font-size:10px;color:#888;margin-top:3px">3.5×4.5 cm, max 2MB</p>
                </div>
                <div style="flex:1">
                    <div class="form-2col">
                        <div class="form-group">
                            <label>নাম (বাংলায়) <span style="color:red">*</span></label>
                            <input type="text" name="name_bn" class="form-ctrl @error('name_bn') invalid @enderror"
                                value="{{ old('name_bn') }}" required>
                            @error('name_bn')
                                <div class="err-msg">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>নাম (ইংরেজিতে) <span style="color:red">*</span></label>
                            <input type="text" name="name_en" class="form-ctrl @error('name_en') invalid @enderror"
                                value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="err-msg">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-2col">
                        <div class="form-group">
                            <label>আবেদনকৃত শ্রেণি <span style="color:red">*</span></label>
                            <select name="applying_class" class="form-ctrl" required>
                                <option value="">-- নির্বাচন করুন --</option>
                                <option value="6" {{ old('applying_class') == '6' ? 'selected' : '' }}>ষষ্ঠ শ্রেণি
                                    (Class
                                    Six)</option>
                                <option value="7" {{ old('applying_class') == '7' ? 'selected' : '' }}>সপ্তম শ্রেণি
                                </option>
                                <option value="8" {{ old('applying_class') == '8' ? 'selected' : '' }}>অষ্টম শ্রেণি
                                </option>
                                <option value="9" {{ old('applying_class') == '9' ? 'selected' : '' }}>নবম শ্রেণি
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>জন্ম তারিখ <span style="color:red">*</span></label>
                            <input type="date" name="dob" class="form-ctrl" value="{{ old('dob') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Parent Info --}}
        <div class="adm-block">
            <div class="adm-block-title"><i class="fas fa-users"></i> অভিভাবকের তথ্য</div>
            <div class="form-2col">
                <div class="form-group"><label>পিতার নাম <span style="color:red">*</span></label><input type="text"
                        name="father_name" class="form-ctrl" value="{{ old('father_name') }}" required></div>
                <div class="form-group"><label>মাতার নাম <span style="color:red">*</span></label><input type="text"
                        name="mother_name" class="form-ctrl" value="{{ old('mother_name') }}" required></div>
                <div class="form-group"><label>পিতার পেশা</label><input type="text" name="father_occupation"
                        class="form-ctrl" value="{{ old('father_occupation') }}"></div>
                <div class="form-group"><label>মাসিক আয়</label><input type="text" name="monthly_income"
                        class="form-ctrl" value="{{ old('monthly_income') }}" placeholder="টাকায়"></div>
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="adm-block">
            <div class="adm-block-title"><i class="fas fa-id-card"></i> ব্যক্তিগত তথ্য</div>
            <div class="form-2col">
                <div class="form-group">
                    <label>লিঙ্গ <span style="color:red">*</span></label>
                    <select name="gender" class="form-ctrl" required>
                        <option value="">-- নির্বাচন করুন --</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ছেলে</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>মেয়ে</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ধর্ম <span style="color:red">*</span></label>
                    <select name="religion" class="form-ctrl" required>
                        <option value="">-- নির্বাচন করুন --</option>
                        <option value="islam" {{ old('religion') == 'islam' ? 'selected' : '' }}>ইসলাম</option>
                        <option value="hindu" {{ old('religion') == 'hindu' ? 'selected' : '' }}>হিন্দু</option>
                        <option value="buddhist" {{ old('religion') == 'buddhist' ? 'selected' : '' }}>বৌদ্ধ</option>
                        <option value="christian" {{ old('religion') == 'christian' ? 'selected' : '' }}>খ্রিষ্টান
                        </option>
                        <option value="other" {{ old('religion') == 'other' ? 'selected' : '' }}>অন্যান্য</option>
                    </select>
                </div>
                <div class="form-group"><label>জন্ম নিবন্ধন নম্বর</label><input type="text" name="birth_cert_no"
                        class="form-ctrl" value="{{ old('birth_cert_no') }}"></div>
                <div class="form-group"><label>মোবাইল নম্বর <span style="color:red">*</span></label><input type="text"
                        name="mobile" class="form-ctrl @error('mobile') invalid @enderror" value="{{ old('mobile') }}"
                        required placeholder="01XXXXXXXXX">
                    @error('mobile')
                        <div class="err-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"><label>ইমেইল</label><input type="email" name="email" class="form-ctrl"
                        value="{{ old('email') }}"></div>
            </div>
            <div class="form-group"><label>বর্তমান ঠিকানা <span style="color:red">*</span></label>
                <textarea name="address" class="form-ctrl" rows="2" required>{{ old('address') }}</textarea>
            </div>
        </div>

        {{-- Previous School --}}
        <div class="adm-block">
            <div class="adm-block-title"><i class="fas fa-school"></i> পূর্ববর্তী বিদ্যালয়ের তথ্য</div>
            <div class="form-2col">
                <div class="form-group"><label>বিদ্যালয়ের নাম</label><input type="text" name="prev_school"
                        class="form-ctrl" value="{{ old('prev_school') }}"></div>
                <div class="form-group"><label>পূর্ববর্তী শ্রেণি</label><input type="text" name="prev_class"
                        class="form-ctrl" value="{{ old('prev_class') }}" placeholder="যেমন: পঞ্চম"></div>
                <div class="form-group"><label>GPA / ফলাফল</label><input type="text" name="prev_result"
                        class="form-ctrl" value="{{ old('prev_result') }}" placeholder="যেমন: GPA 5.00"></div>
            </div>
        </div>

        <div style="text-align:center;padding:10px 0 16px">
            <button type="submit" class="btn btn-primary" style="padding:11px 50px;font-size:15px">
                <i class="fas fa-paper-plane"></i> আবেদন জমা দিন
            </button>
            <a href="{{ route('home') }}" class="btn"
                style="margin-left:12px;padding:11px 24px;background:#f5f5f5;border:1px solid #ddd;color:#555;font-size:15px">বাতিল</a>
        </div>
    </form>
@endsection
