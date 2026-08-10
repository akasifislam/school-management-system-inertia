@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-bullhorn"></i>
                {{ isset($announcement) ? 'ঘোষণা সম্পাদনা' : 'নতুন ঘোষণা তৈরি করুন' }}
            </h3>
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($announcement) ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}"
                method="POST">
                @csrf
                @if (isset($announcement))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label>শিরোনাম *</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title', $announcement->title ?? '') }}" required placeholder="ঘোষণার শিরোনাম লিখুন">
                </div>
                <div class="form-group">
                    <label>বার্তা / বিস্তারিত *</label>
                    <textarea name="message" class="form-control" rows="5" required placeholder="ঘোষণার বিস্তারিত বার্তা লিখুন...">{{ old('message', $announcement->message ?? '') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>ঘোষণার ধরন</label>
                        <select name="type" class="form-control">
                            @foreach (['info' => 'ℹ️ তথ্য (Info — নীল)', 'success' => '✅ সফলতা (Success — সবুজ)', 'warning' => '⚠️ সতর্কতা (Warning — হলুদ)', 'danger' => '🚨 জরুরি (Danger — লাল)'] as $val => $lbl)
                                <option value="{{ $val }}"
                                    {{ old('type', $announcement->type ?? 'info') === $val ? 'selected' : '' }}>
                                    {{ $lbl }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>লাইভ প্রিভিউ</label>
                        <div id="preview"
                            style="padding:12px;border-radius:4px;font-size:13px;background:#E3F2FD;border-left:4px solid #1565C0;color:#0D47A1">
                            <strong id="prevTitle">শিরোনাম</strong><br>
                            <span id="prevMsg" style="font-size:12px">বার্তা</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>শুরুর তারিখ <small style="color:#888">(খালি = সাথে সাথে)</small></label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ old('start_date', isset($announcement) ? $announcement->start_date?->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label>শেষের তারিখ <small style="color:#888">(খালি = সীমাহীন)</small></label>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ old('end_date', isset($announcement) ? $announcement->end_date?->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:16px">
                    <div style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:6px;padding:14px">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;margin:0">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $announcement->is_active ?? true) ? 'checked' : '' }}
                                style="width:18px;height:18px;cursor:pointer">
                            <div><strong style="font-size:13px">✅ সক্রিয়</strong>
                                <div style="font-size:11px;color:#888;margin-top:2px">ঘোষণাটি প্রদর্শন করবে</div>
                            </div>
                        </label>
                    </div>
                    <div style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:6px;padding:14px">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;margin:0">
                            <input type="checkbox" name="show_popup" value="1"
                                {{ old('show_popup', $announcement->show_popup ?? false) ? 'checked' : '' }}
                                style="width:18px;height:18px;cursor:pointer">
                            <div><strong style="font-size:13px">🔔 Popup</strong>
                                <div style="font-size:11px;color:#888;margin-top:2px">পেজ লোডে পপআপ দেখাবে</div>
                            </div>
                        </label>
                    </div>
                    <div style="background:#f8f9fa;border:1px solid #dde1e9;border-radius:6px;padding:14px">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;margin:0">
                            <input type="checkbox" name="show_banner" value="1"
                                {{ old('show_banner', $announcement->show_banner ?? false) ? 'checked' : '' }}
                                style="width:18px;height:18px;cursor:pointer">
                            <div><strong style="font-size:13px">📢 ব্যানার</strong>
                                <div style="font-size:11px;color:#888;margin-top:2px">পেজের উপরে ব্যানার দেখাবে</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        {{ isset($announcement) ? 'আপডেট' : 'সংরক্ষণ' }}</button>
                    <a href="{{ route('admin.announcements.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const typeColors = {
                info: {
                    bg: '#E3F2FD',
                    border: '#1565C0',
                    text: '#0D47A1'
                },
                success: {
                    bg: '#E8F5E9',
                    border: '#2E7D32',
                    text: '#1B5E20'
                },
                warning: {
                    bg: '#FFF8E1',
                    border: '#F57F17',
                    text: '#E65100'
                },
                danger: {
                    bg: '#FFEBEE',
                    border: '#C62828',
                    text: '#B71C1C'
                },
            };

            function updatePreview() {
                const type = document.querySelector('[name=type]').value;
                const title = document.querySelector('[name=title]').value || 'শিরোনাম';
                const msg = document.querySelector('[name=message]').value || 'বার্তা';
                const c = typeColors[type] || typeColors.info;
                const p = document.getElementById('preview');
                p.style.background = c.bg;
                p.style.borderLeftColor = c.border;
                p.style.color = c.text;
                document.getElementById('prevTitle').textContent = title;
                document.getElementById('prevMsg').textContent = msg.substring(0, 100);
            }
            document.querySelector('[name=type]').addEventListener('change', updatePreview);
            document.querySelector('[name=title]').addEventListener('input', updatePreview);
            document.querySelector('[name=message]').addEventListener('input', updatePreview);
            updatePreview();
        </script>
    @endpush
@endsection
