@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-toggle-on"></i>
                সাইট কন্ট্রোল — ফিচার চালু/বন্ধ
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.site-controls.update') }}" method="POST">
                @csrf
                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin-bottom:14px;padding-bottom:6px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-toggle-on"></i> ফিচার সুইচ
                </h4>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:22px">
                    @php
                        $toggles = [
                            [
                                'key' => 'allow_admission',
                                'label' => 'ভর্তি আবেদন',
                                'desc' => 'ওয়েবসাইটে ভর্তির ফর্ম দেখাবে',
                                'icon' => 'fas fa-file-alt',
                                'color' => '#1565C0',
                            ],
                            [
                                'key' => 'allow_result_view',
                                'label' => 'পরীক্ষার ফলাফল',
                                'desc' => 'ফলাফল পেজ দর্শকরা দেখতে পাবেন',
                                'icon' => 'fas fa-poll',
                                'color' => '#2E7D32',
                            ],
                            [
                                'key' => 'show_gallery',
                                'label' => 'ছবির গ্যালারী',
                                'desc' => 'গ্যালারী পেজ প্রদর্শন করবে',
                                'icon' => 'fas fa-images',
                                'color' => '#7B1FA2',
                            ],
                            [
                                'key' => 'show_ticker',
                                'label' => 'খবর টিকার',
                                'desc' => 'হোমপেজে স্ক্রলিং খবর দেখাবে',
                                'icon' => 'fas fa-scroll',
                                'color' => '#0097A7',
                            ],
                            [
                                'key' => 'show_notice',
                                'label' => 'নোটিশ বোর্ড',
                                'desc' => 'হোমপেজে নোটিশ বোর্ড দেখাবে',
                                'icon' => 'fas fa-bell',
                                'color' => '#E53935',
                            ],
                            [
                                'key' => 'show_download',
                                'label' => 'ডাউনলোড সেকশন',
                                'desc' => 'হোমপেজে ডাউনলোড সেকশন দেখাবে',
                                'icon' => 'fas fa-download',
                                'color' => '#F57F17',
                            ],
                            [
                                'key' => 'registration_open',
                                'label' => 'রেজিস্ট্রেশন',
                                'desc' => 'নতুন ভর্তি আবেদন গ্রহণ করা হবে',
                                'icon' => 'fas fa-pen',
                                'color' => '#1976D2',
                            ],
                            [
                                'key' => 'sms_notification',
                                'label' => 'SMS নোটিফিকেশন',
                                'desc' => 'আবেদন সফলে SMS পাঠানো হবে (API)',
                                'icon' => 'fas fa-sms',
                                'color' => '#388E3C',
                            ],
                        ];
                    @endphp

                    @foreach ($toggles as $t)
                        <div
                            style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:8px;padding:14px;display:flex;align-items:center;gap:14px">
                            <div
                                style="width:42px;height:42px;border-radius:10px;background:{{ $t['color'] }};display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;flex-shrink:0">
                                <i class="{{ $t['icon'] }}"></i>
                            </div>
                            <div style="flex:1">
                                <div style="font-weight:700;font-size:13px;color:#263238">{{ $t['label'] }}</div>
                                <div style="font-size:11px;color:#888;margin-top:2px">{{ $t['desc'] }}</div>
                            </div>
                            <label class="toggle-switch" title="{{ $t['label'] }}">
                                <input type="checkbox" name="{{ $t['key'] }}" value="1"
                                    {{ ($controls[$t['key']] ?? '1') === '1' ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    @endforeach

                </div>

                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin-bottom:14px;padding-bottom:6px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-cog"></i> সাধারণ সেটিং
                </h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>বর্তমান একাডেমিক বছর</label>
                        <select name="academic_year" class="form-control">
                            @foreach (range(date('Y') + 1, date('Y') - 3) as $y)
                                <option value="{{ $y }}"
                                    {{ ($controls['academic_year'] ?? date('Y')) == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>যোগাযোগ ইমেইল</label>
                        <input type="email" name="contact_email" class="form-control"
                            value="{{ $controls['contact_email'] ?? '' }}" placeholder="admin@school.edu.bd">
                    </div>
                </div>

                <div class="form-group">
                    <label>ফুটার নোট</label>
                    <input type="text" name="footer_note" class="form-control"
                        value="{{ $controls['footer_note'] ?? '' }}" placeholder="বিদ্যালয়ের অফিসিয়াল ওয়েবসাইট">
                </div>

                <h4
                    style="font-size:13px;font-weight:700;color:#1565C0;margin:20px 0 14px;padding-bottom:6px;border-bottom:1px solid #eef0f4">
                    <i class="fas fa-code"></i> কাস্টম কোড (উন্নত ব্যবহারকারী)
                </h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>Google Analytics ID <small style="color:#888">(UA-XXXXX বা G-XXXXX)</small></label>
                        <input type="text" name="google_analytics" class="form-control"
                            value="{{ $controls['google_analytics'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>কাস্টম CSS <small style="color:#888">(সব পেজে যোগ হবে)</small></label>
                        <textarea name="custom_css" class="form-control" rows="4"
                            placeholder="/* আপনার CSS এখানে */&#10;.my-class { color: red; }">{{ $controls['custom_css'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>কাস্টম JavaScript <small style="color:#888">(সব পেজে যোগ হবে)</small></label>
                        <textarea name="custom_js" class="form-control" rows="4"
                            placeholder="// আপনার JS এখানে&#10;console.log('Hello');">{{ $controls['custom_js'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> সব সেটিং সংরক্ষণ
                        করুন</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 26px;
            flex-shrink: 0;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: #ccc;
            border-radius: 26px;
            transition: .3s;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background: #fff;
            border-radius: 50%;
            transition: .3s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        .toggle-switch input:checked+.toggle-slider {
            background: #1565C0;
        }

        .toggle-switch input:checked+.toggle-slider::before {
            transform: translateX(22px);
        }
    </style>
@endsection
