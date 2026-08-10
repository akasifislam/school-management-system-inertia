@extends('layouts.admin')
@section('content')
    <div style="display:flex;gap:6px;margin-bottom:18px;flex-wrap:wrap">
        @foreach (['section-basic' => '<i class="fas fa-school"></i> বিদ্যালয় তথ্য', 'section-contact' => '<i class="fas fa-envelope"></i> যোগাযোগ', 'section-principal' => '<i class="fas fa-user-tie"></i> প্রধান শিক্ষক', 'section-appearance' => '<i class="fas fa-image"></i> লোগো/ব্যানার', 'section-history' => '<i class="fas fa-history"></i> ইতিহাস', 'section-apa' => '<i class="fas fa-chart-bar"></i> এপিএ', 'section-sudhachar' => '<i class="fas fa-star"></i> সুধাচার'] as $id => $label)
            <a href="#{{ $id }}" class="config-tab"
                onclick="showTab('{{ $id }}',this)">{!! $label !!}</a>
        @endforeach
    </div>

    {{-- Basic Info --}}
    <div id="section-basic" class="config-section">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-school"></i> বিদ্যালয়ের মূল তথ্য</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.update') }}" method="POST">@csrf @method('PUT')
                    <div class="form-row">
                        <div class="form-group"><label>EIIN নম্বর</label><input type="text" name="eiin"
                                class="form-control" value="{{ old('eiin', $about->eiin ?? '105709') }}"></div>
                        <div class="form-group"><label>শিক্ষার্থীর সংখ্যা</label><input type="number" name="student_count"
                                class="form-control" value="{{ old('student_count', $about->student_count ?? 833) }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>বিদ্যালয়ের নাম (বাংলা)</label><input type="text" name="name_bn"
                                class="form-control" value="{{ old('name_bn', $about->name_bn ?? '') }}"></div>
                        <div class="form-group"><label>School Name (English)</label><input type="text" name="name_en"
                                class="form-control" value="{{ old('name_en', $about->name_en ?? '') }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>গ্রাম/বাড়ী</label><input type="text" name="village"
                                class="form-control" value="{{ old('village', $about->village ?? 'কোটবাড়ী') }}"></div>
                        <div class="form-group"><label>ওয়ার্ড নম্বর</label><input type="text" name="ward"
                                class="form-control" value="{{ old('ward', $about->ward ?? '২৪') }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>পোষ্ট অফিস</label><input type="text" name="post_office"
                                class="form-control" value="{{ old('post_office', $about->post_office ?? 'কোটবাড়ী') }}">
                        </div>
                        <div class="form-group"><label>পোষ্ট কোড</label><input type="text" name="post_code"
                                class="form-control" value="{{ old('post_code', $about->post_code ?? '৩৫০০') }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>পুলিশ স্টেশন</label><input type="text" name="police_station"
                                class="form-control"
                                value="{{ old('police_station', $about->police_station ?? 'কুমিল্লা সদর দক্ষিণ') }}"></div>
                        <div class="form-group"><label>উপজেলা</label><input type="text" name="upazila"
                                class="form-control" value="{{ old('upazila', $about->upazila ?? 'সদর দক্ষিণ') }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>জেলা</label><input type="text" name="district"
                                class="form-control" value="{{ old('district', $about->district ?? 'কুমিল্লা') }}"></div>
                        <div class="form-group"><label>বিভাগ</label><input type="text" name="division"
                                class="form-control" value="{{ old('division', $about->division ?? 'চট্টগ্রাম') }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>মোট জমি (একর)</label><input type="text" name="land_area"
                                class="form-control" value="{{ old('land_area', $about->land_area ?? '6.36') }}"></div>
                        <div class="form-group"><label>ভবন সংখ্যা</label><input type="number" name="buildings"
                                class="form-control" value="{{ old('buildings', $about->buildings ?? 10) }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>মোট শ্রেণিকক্ষ</label><input type="number" name="classrooms"
                                class="form-control" value="{{ old('classrooms', $about->classrooms ?? 21) }}"></div>
                        <div class="form-group"><label>মাল্টিমিডিয়া ক্লাসরুম</label><input type="number"
                                name="multimedia_rooms" class="form-control"
                                value="{{ old('multimedia_rooms', $about->multimedia_rooms ?? 12) }}"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>আইসিটি ল্যাব</label><input type="number" name="ict_labs"
                                class="form-control" value="{{ old('ict_labs', $about->ict_labs ?? 1) }}"></div>
                        <div class="form-group"><label>বিজ্ঞানাগার কক্ষ</label><input type="number" name="science_labs"
                                class="form-control" value="{{ old('science_labs', $about->science_labs ?? 6) }}"></div>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ করুন</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Contact --}}
    <div id="section-contact" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-envelope"></i> যোগাযোগ তথ্য</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.update') }}" method="POST">@csrf @method('PUT')
                    <div class="form-row">
                        <div class="form-group"><label>টেলিফোন</label><input type="text" name="phone"
                                class="form-control" value="{{ old('phone', $contact->phone ?? '02304430593') }}"></div>
                        <div class="form-group"><label>ইমেইল</label><input type="email" name="email"
                                class="form-control"
                                value="{{ old('email', $contact->email ?? 'govlabcomilla@gmail.com') }}"></div>
                    </div>
                    <div class="form-group"><label>ওয়েবসাইট</label><input type="text" name="website"
                            class="form-control"
                            value="{{ old('website', $contact->website ?? 'www.govlabcomilla.edu.bd') }}"></div>
                    <div class="form-group"><label>গুগল ম্যাপ এম্বেড কোড</label>
                        <textarea name="map_embed" class="form-control" rows="4">{{ old('map_embed', $contact->map_embed ?? '') }}</textarea>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Principal --}}
    <div id="section-principal" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-user-tie"></i> প্রধান শিক্ষক তথ্য</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.principal.update') }}" method="POST" enctype="multipart/form-data">@csrf
                    @method('PUT')
                    <div style="display:flex;gap:22px;align-items:flex-start">
                        <div style="text-align:center;flex-shrink:0">
                            <img id="principalPreview"
                                src="{{ isset($principal) && $principal->photo ? asset('storage/' . $principal->photo) : '' }}"
                                class="photo-preview"
                                style="{{ isset($principal) && $principal->photo ? '' : 'display:none;' }}width:120px;height:140px"
                                alt="">
                            <div class="form-group" style="margin-top:8px"><label
                                    style="font-size:11px">ছবি</label><input type="file" name="photo"
                                    class="form-control" accept="image/*" data-preview="principalPreview"></div>
                        </div>
                        <div style="flex:1">
                            <div class="form-row">
                                <div class="form-group"><label>নাম *</label><input type="text" name="name"
                                        class="form-control"
                                        value="{{ old('name', $principal->name ?? 'রোকসানা ফেরদৌস মজুমদার') }}" required>
                                </div>
                                <div class="form-group"><label>পদবী</label><input type="text" name="designation"
                                        class="form-control"
                                        value="{{ old('designation', $principal->designation ?? 'প্রধান শিক্ষক') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group"><label>ফোন</label><input type="text" name="phone"
                                        class="form-control" value="{{ old('phone', $principal->phone ?? '') }}"></div>
                                <div class="form-group"><label>যোগদানের তারিখ</label><input type="date"
                                        name="joining_date" class="form-control"
                                        value="{{ old('joining_date', isset($principal) ? $principal->joining_date?->format('Y-m-d') : '') }}">
                                </div>
                            </div>
                            <div class="form-group"><label>বার্তা</label>
                                <textarea name="message" class="form-control" rows="4">{{ old('message', $principal->message ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Appearance --}}
    <div id="section-appearance" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-image"></i> লোগো ও ব্যানার</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">@csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group"><label>স্কুলের লোগো</label>
                            @if (!empty($settings['logo']))
                                <img src="{{ asset('storage/' . $settings['logo']) }}"
                                    style="width:80px;height:80px;object-fit:contain;display:block;border:1px solid #dde1e9;margin-bottom:8px"
                                    alt="">
                            @endif
                            <input type="file" name="logo" class="form-control" accept="image/*"
                                data-preview="logoPreview2">
                            <img id="logoPreview2"
                                style="display:none;width:80px;height:80px;object-fit:contain;margin-top:8px;border:1px solid #dde1e9"
                                alt="">
                        </div>
                        <div class="form-group"><label>হেডার ব্যানার (প্রশস্ত ছবি)</label>
                            @if (!empty($settings['banner']))
                                <img src="{{ asset('storage/' . $settings['banner']) }}"
                                    style="width:250px;height:65px;object-fit:cover;display:block;border:1px solid #dde1e9;margin-bottom:8px"
                                    alt="">
                            @endif
                            <input type="file" name="banner" class="form-control" accept="image/*"
                                data-preview="bannerPreview2"><img id="bannerPreview2"
                                style="display:none;width:250px;height:65px;object-fit:cover;margin-top:8px;border:1px solid #dde1e9"
                                alt="">
                        </div>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- History --}}
    <div id="section-history" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-history"></i> সংক্ষিপ্ত ইতিহাস</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.history.update') }}" method="POST">@csrf @method('PUT')
                    <div class="form-group"><label>বিষয়বস্তু (HTML সাপোর্টেড)</label>
                        <textarea name="content" class="form-control" rows="16">{{ old('content', $history ?? '') }}</textarea><small style="color:#888;font-size:12px">HTML ট্যাগ ব্যবহার করতে পারবেন।
                            যেমন: &lt;p&gt;, &lt;h3&gt;, &lt;strong&gt;, &lt;ul&gt;&lt;li&gt;</small>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- APA --}}
    <div id="section-apa" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-chart-bar"></i> এপিএ (Annual Performance Agreement)</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.apa.update') }}" method="POST">@csrf @method('PUT')
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="18">{{ old('content', $apa ?? '') }}</textarea>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sudhachar --}}
    <div id="section-sudhachar" class="config-section" style="display:none">
        <div class="admin-card">
            <div class="card-header">
                <h3><i class="fas fa-star"></i> সুধাচার কৌশল</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sudhachar.update') }}" method="POST">@csrf @method('PUT')
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="18">{{ old('content', $sudhachar ?? '') }}</textarea>
                    </div>
                    <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                            সংরক্ষণ</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
