@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">
        অধ্যয়নরত শিক্ষার্থীর সংখ্যা</div>
    <form method="GET" action="{{ route('students.count') }}">
        <table class="info-tbl">
            <tr>
                <td>Academic Year :</td>
                <td><select name="year" class="filter-sel" onchange="this.form.submit()">
                        @foreach ($academicYears as $y)
                            <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Class :</td>
                <td><select name="class" class="filter-sel" onchange="this.form.submit()">
                        <option value="">Select Class</option>
                        @foreach (['Six', 'Seven', 'Eight', 'Nine', 'Ten'] as $c)
                            <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>
                                {{ $c }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Shift :</td>
                <td><select name="shift" class="filter-sel" onchange="this.form.submit()">
                        <option value="">Select Shift</option>
                        <option value="Day" {{ request('shift') == 'Day' ? 'selected' : '' }}>Day</option>
                        <option value="Morning" {{ request('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                    </select></td>
            </tr>
            <tr>
                <td>Section :</td>
                <td><select name="section" class="filter-sel" onchange="this.form.submit()">
                        <option value="">Select Section</option>
                        @foreach (['A', 'B', 'C', 'D', 'E'] as $s)
                            <option value="{{ $s }}" {{ request('section') == $s ? 'selected' : '' }}>
                                {{ $s }}</option>
                        @endforeach
                    </select></td>
            </tr>
            <tr style="background:#E3F2FD">
                <td colspan="2" style="text-align:center;font-weight:700;color:#1565C0;font-size:14px">Total Students :
                    {{ $totalFiltered }}</td>
            </tr>
        </table>
    </form>
    @if ($studentData->count())
        <div style="overflow-x:auto">
            <table class="std-tbl">
                <thead>
                    @if ($hasFilter)
                        <tr>
                            <th>শ্রেণি</th>
                            <th>শিফট</th>
                            <th>সেকশন</th>
                            <th>ছেলে</th>
                            <th>মেয়ে</th>
                            <th>মোট</th>
                            <th>মুসলিম</th>
                            <th>হিন্দু</th>
                            <th>বৌদ্ধ</th>
                            <th>খ্রিষ্টান</th>
                            <th>বিজ্ঞান</th>
                            <th>সা.সং.</th>
                            <th>অটিস্টিক</th>
                            <th>শারীরিক</th>
                        </tr>
                    @else
                        <tr>
                            <th rowspan="2">শ্রেণি</th>
                            <th rowspan="2">শিফট</th>
                            <th rowspan="2">সেকশন</th>
                            <th colspan="3">শিক্ষার্থী</th>
                            <th colspan="4">ধর্ম</th>
                            <th colspan="2">মুক্তিযোদ্ধা</th>
                            <th colspan="2">প্রতিবন্ধি</th>
                        </tr>
                        <tr>
                            <th>ছেলে</th>
                            <th>মেয়ে</th>
                            <th>মোট</th>
                            <th>মুসলিম</th>
                            <th>হিন্দু</th>
                            <th>বৌদ্ধ</th>
                            <th>খ্রিষ্টান</th>
                            <th>বিজ্ঞান</th>
                            <th>সা.সং.</th>
                            <th>অটিস্টিক</th>
                            <th>শারীরিক</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach ($studentData as $r)
                        <tr>
                            <td>{{ $r->class }}</td>
                            <td>{{ $r->shift }}</td>
                            <td>{{ $r->section ?? '—' }}</td>
                            <td>{{ $r->boys }}</td>
                            <td>{{ $r->girls }}</td>
                            <td><strong>{{ $r->total }}</strong></td>
                            <td>{{ $r->muslim }}</td>
                            <td>{{ $r->hindu }}</td>
                            <td>{{ $r->buddhist }}</td>
                            <td>{{ $r->christian }}</td>
                            <td>{{ $r->ff_science }}</td>
                            <td>{{ $r->ff_general }}</td>
                            <td>{{ $r->autistic }}</td>
                            <td>{{ $r->physical }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3"><strong>সর্বমোট</strong></td>
                        <td><strong>{{ $studentData->sum('boys') }}</strong></td>
                        <td><strong>{{ $studentData->sum('girls') }}</strong></td>
                        <td><strong>{{ $studentData->sum('total') }}</strong></td>
                        <td><strong>{{ $studentData->sum('muslim') }}</strong></td>
                        <td><strong>{{ $studentData->sum('hindu') }}</strong></td>
                        <td><strong>{{ $studentData->sum('buddhist') }}</strong></td>
                        <td><strong>{{ $studentData->sum('christian') }}</strong></td>
                        <td><strong>{{ $studentData->sum('ff_science') }}</strong></td>
                        <td><strong>{{ $studentData->sum('ff_general') }}</strong></td>
                        <td><strong>{{ $studentData->sum('autistic') }}</strong></td>
                        <td><strong>{{ $studentData->sum('physical') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
@endsection
