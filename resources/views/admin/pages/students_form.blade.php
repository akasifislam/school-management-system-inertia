@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3><i class="fas fa-chart-bar"></i> {{ isset($studentRow) ? 'রেকর্ড সম্পাদনা' : 'নতুন রেকর্ড' }}</h3><a
                href="{{ route('admin.students.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9">
                <i class="fas fa-arrow-left"></i> ফিরে যান
            </a>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($studentRow) ? route('admin.students.update', $studentRow) : route('admin.students.store') }}"
                method="POST">
                @csrf @if (isset($studentRow))
                    @method('PUT')
                @endif
                <div class="form-row">
                    <div class="form-group">
                        <label>শ্রেণি *</label>
                        <select name="class" class="form-control" required>
                            @foreach (['Six', 'Seven', 'Eight', 'Nine', 'Ten'] as $c)
                                <option value="{{ $c }}"
                                    {{ old('class', $studentRow->class ?? '') === $c ? 'selected' : '' }}>
                                    {{ $c }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>শিফট *</label>
                        <select name="shift" class="form-control" required>
                            <option value="Day"
                                {{ old('shift', $studentRow->shift ?? 'Day') === 'Day' ? 'selected' : '' }}>Day
                            </option>
                            <option value="Morning"
                                {{ old('shift', $studentRow->shift ?? '') === 'Morning' ? 'selected' : '' }}>
                                Morning</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>সেকশন</label><select name="section" class="form-control">
                            <option value="">নেই</option>
                            @foreach (['A', 'B', 'C', 'D', 'E'] as $s)
                                <option value="{{ $s }}"
                                    {{ old('section', $studentRow->section ?? '') === $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select></div>
                    <div class="form-group"><label>মোট শিক্ষার্থী</label><input type="number" name="total"
                            class="form-control" value="{{ old('total', $studentRow->total ?? 0) }}" min="0"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>ছেলে</label><input type="number" name="boys" class="form-control"
                            value="{{ old('boys', $studentRow->boys ?? 0) }}" min="0"></div>
                    <div class="form-group"><label>মেয়ে</label><input type="number" name="girls" class="form-control"
                            value="{{ old('girls', $studentRow->girls ?? 0) }}" min="0"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>মুসলিম</label><input type="number" name="muslim" class="form-control"
                            value="{{ old('muslim', $studentRow->muslim ?? 0) }}" min="0"></div>
                    <div class="form-group"><label>হিন্দু</label><input type="number" name="hindu" class="form-control"
                            value="{{ old('hindu', $studentRow->hindu ?? 0) }}" min="0"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>বৌদ্ধ</label><input type="number" name="buddhist" class="form-control"
                            value="{{ old('buddhist', $studentRow->buddhist ?? 0) }}" min="0"></div>
                    <div class="form-group"><label>খ্রিষ্টান</label><input type="number" name="christian"
                            class="form-control" value="{{ old('christian', $studentRow->christian ?? 0) }}"
                            min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>বিজ্ঞান (মুক্তিযোদ্ধা)</label><input type="number" name="ff_science"
                            class="form-control" value="{{ old('ff_science', $studentRow->ff_science ?? 0) }}"
                            min="0">
                    </div>
                    <div class="form-group"><label>সা.সংরক্ষণ</label><input type="number" name="ff_general"
                            class="form-control" value="{{ old('ff_general', $studentRow->ff_general ?? 0) }}"
                            min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>অটিস্টিক</label><input type="number" name="autistic"
                            class="form-control" value="{{ old('autistic', $studentRow->autistic ?? 0) }}" min="0">
                    </div>
                    <div class="form-group"><label>শারীরিক প্রতিবন্ধি</label><input type="number" name="physical"
                            class="form-control" value="{{ old('physical', $studentRow->physical ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        সংরক্ষণ</button><a href="{{ route('admin.students.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
