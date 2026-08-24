@extends('layouts.admin')
@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-poll"></i> {{ isset($result) ? 'ফলাফল সম্পাদনা' : 'নতুন ফলাফল' }}
            </h3>
            <a href="{{ route('admin.results.index') }}" class="btn btn-sm"
                style="background:#f5f7fa;border:1px solid #dde1e9">
                <i class="fas fa-arrow-left"></i> ফিরে যান
            </a>
        </div>
        <div class="card-body">
            <form action="{{ isset($result) ? route('admin.results.update', $result) : route('admin.results.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf @if (isset($result))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label>শিরোনাম *</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title', $result->title ?? '') }}" required>
                </div>
                <div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quia pariatur error minus soluta sunt
                    expedita esse? Nemo earum corporis voluptas itaque saepe nostrum mollitia iste porro, unde autem quasi.
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>পরীক্ষার ধরন *</label>
                        <select name="exam_type" class="form-control" required>
                            <option value="">-- নির্বাচন করুন --</option>
                            @foreach (['JSC' => 'JSC', 'SSC' => 'SSC', 'Half_Yearly' => 'অর্ধ-বার্ষিক', 'Annual' => 'বার্ষিক', 'Admission' => 'ভর্তি পরীক্ষা'] as $val => $lbl)
                                <option value="{{ $val }}"
                                    {{ old('exam_type', $result->exam_type ?? '') === $val ? 'selected' : '' }}>
                                    {{ $lbl }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>বছর *</label>
                        <input type="number" name="year" class="form-control"
                            value="{{ old('year', $result->year ?? date('Y')) }}" min="2000" max="2099" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>বিবরণ</label>
                    <textarea name="description" class="form-control" rows="3">
                        {{ old('description', $result->description ?? '') }}
                    </textarea>
                </div>
                <div class="form-group"><label>ফাইল (PDF) {{ isset($result) ? '' : '*' }}</label><input type="file"
                        name="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png"
                        {{ isset($result) ? '' : 'required' }}>
                    @if (isset($result) && $result->file)
                        <div style="margin-top:6px;font-size:12px"><a href="{{ asset('storage/' . $result->file) }}"
                                target="_blank" style="color:#1565C0">বিদ্যমান ফাইল</a></div>
                    @endif
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                        সংরক্ষণ</button><a href="{{ route('admin.results.index') }}" class="btn"
                        style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
            </form>
        </div>
    </div>
@endsection
