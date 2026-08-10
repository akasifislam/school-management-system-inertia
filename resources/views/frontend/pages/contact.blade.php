@extends('layouts.frontend')
@section('content')
    <div class="page-hdr">যোগাযোগ</div>
    <table class="info-tbl">
        <tr>
            <td>বিদ্যালয়ের নাম</td>
            <td>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</td>
        </tr>
        <tr>
            <td>গ্রাম/বাড়ী ও সড়কের বিবরণ</td>
            <td>{{ $contact->village ?? 'কোটবাড়ী' }}</td>
        </tr>
        <tr>
            <td>ওয়ার্ড নম্বর</td>
            <td>{{ $contact->ward ?? '২৪' }}</td>
        </tr>
        <tr>
            <td>ইউনিয়ন/পৌরসভা/সিটি কর্পোরেশন</td>
            <td>{{ $contact->city_corp ?? 'কুমিল্লা সিটি কর্পোরেশন' }}</td>
        </tr>
        <tr>
            <td>পোষ্ট অফিস</td>
            <td>{{ $contact->post_office ?? 'কোটবাড়ী' }}</td>
        </tr>
        <tr>
            <td>পোষ্ট কোড</td>
            <td>{{ $contact->post_code ?? '৩৫০০' }}</td>
        </tr>
        <tr>
            <td>পুলিশ স্টেশন</td>
            <td>{{ $contact->police_station ?? 'কুমিল্লা সদর দক্ষিণ' }}</td>
        </tr>
        <tr>
            <td>উপজেলা</td>
            <td>{{ $contact->upazila ?? 'সদর দক্ষিণ' }}</td>
        </tr>
        <tr>
            <td>জেলা</td>
            <td>{{ $contact->district ?? 'কুমিল্লা' }}</td>
        </tr>
        <tr>
            <td>বিভাগ</td>
            <td>{{ $contact->division ?? 'চট্টগ্রাম' }}</td>
        </tr>
        <tr>
            <td>টেলিফোন</td>
            <td>{{ $contact->phone ?? '02304430593' }}</td>
        </tr>
        <tr>
            <td>E-Mail</td>
            <td>{{ $contact->email ?? 'govlabcomilla@gmail.com' }}</td>
        </tr>
        <tr>
            <td>Website</td>
            <td><a href="http://{{ $contact->website ?? 'www.govlabcomilla.edu.bd' }}"
                    style="color:#1565C0">{{ $contact->website ?? 'www.govlabcomilla.edu.bd' }}</a></td>
        </tr>
    </table>
    @if (!empty($contact->map_embed))
        <div style="padding:15px">{!! $contact->map_embed !!}</div>
    @endif
@endsection
