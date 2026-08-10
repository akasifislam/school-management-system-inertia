<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──────────────────────────────────────────
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@govlab.edu.bd'],
            ['name' => 'Admin', 'email' => 'admin@govlab.edu.bd',
             'password' => Hash::make('admin123'), 'is_admin' => true,
             'created_at' => now(), 'updated_at' => now()]
        );

        // ── Settings ────────────────────────────────────────────
        $settings = [
            'school_name_bn' => 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল',
            'school_name_en' => 'Government Laboratory High School',
            'phone'          => '02304430593',
            'email'          => 'govlabcomilla@gmail.com',
            'website'        => 'www.govlabcomilla.edu.bd',
            'academic_year'  => date('Y'),
            'active_classes' => json_encode(['Six','Seven','Eight','Nine','Ten']),
            'active_shifts'  => json_encode(['Day','Morning']),
            'footer_note'    => 'বিদ্যালয়ের অফিসিয়াল ওয়েবসাইট',
        ];
        foreach ($settings as $k => $v) {
            DB::table('settings')->updateOrInsert(['key' => $k],
                ['key' => $k, 'value' => $v, 'created_at' => now(), 'updated_at' => now()]);
        }

        // ── Principal ───────────────────────────────────────────
        DB::table('principals')->updateOrInsert(['id' => 1], [
            'name' => 'রোকসানা ফেরদৌস মজুমদার', 'designation' => 'প্রধান শিক্ষক',
            'joining_date' => '2022-11-08', 'created_at' => now(), 'updated_at' => now(),
        ]);

        // ── About ───────────────────────────────────────────────
        DB::table('abouts')->updateOrInsert(['id' => 1], [
            'eiin' => '105709', 'name_bn' => 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল',
            'name_en' => 'GOVERNMENT LABORATORY HIGH SCHOOL',
            'village' => 'কোটবাড়ী', 'ward' => '২৪',
            'city_corp' => 'কুমিল্লা সিটি কর্পোরেশন',
            'post_office' => 'কোটবাড়ী', 'post_code' => '৩৫০০',
            'police_station' => 'কুমিল্লা সদর দক্ষিণ', 'upazila' => 'সদর দক্ষিণ',
            'district' => 'কুমিল্লা', 'division' => 'চট্টগ্রাম',
            'phone' => '02304430593', 'email' => 'govlabcomilla@gmail.com',
            'website' => 'www.govlabcomilla.edu.bd', 'student_count' => 833,
            'shift' => 'এক শিফট', 'type' => 'সহশিক্ষা', 'land_area' => '6.36',
            'buildings' => 10, 'classrooms' => 21, 'multimedia_rooms' => 12,
            'ict_labs' => 1, 'science_labs' => 6, 'library_rooms' => 0,
            'has_auditorium' => '-', 'has_boundary' => '-',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // ── Contact ─────────────────────────────────────────────
        DB::table('contacts')->updateOrInsert(['id' => 1], [
            'village' => 'কোটবাড়ী', 'ward' => '২৪',
            'city_corp' => 'কুমিল্লা সিটি কর্পোরেশন',
            'post_office' => 'কোটবাড়ী', 'post_code' => '৩৫০০',
            'police_station' => 'কুমিল্লা সদর দক্ষিণ', 'upazila' => 'সদর দক্ষিণ',
            'district' => 'কুমিল্লা', 'division' => 'চট্টগ্রাম',
            'phone' => '02304430593', 'email' => 'govlabcomilla@gmail.com',
            'website' => 'www.govlabcomilla.edu.bd',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // ── Page Contents ───────────────────────────────────────
        $pages = [
            'history'   => '<h3>বিদ্যালয়ের ইতিহাস</h3><p>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল কুমিল্লার একটি ঐতিহ্যবাহী শিক্ষাপ্রতিষ্ঠান। এটি কুমিল্লা সদর দক্ষিণ উপজেলার কোটবাড়ীতে অবস্থিত।</p>',
            'apa'       => '<h3>এপিএ (Annual Performance Agreement)</h3><p>বার্ষিক কার্যসম্পাদন চুক্তি তথ্য শীঘ্রই যোগ করা হবে।</p>',
            'sudhachar' => '<h3>সুধাচার কৌশল</h3><p>সুধাচার কৌশল তথ্য শীঘ্রই যোগ করা হবে।</p>',
        ];
        foreach ($pages as $k => $v) {
            DB::table('page_contents')->updateOrInsert(['key' => $k],
                ['key' => $k, 'content' => $v, 'created_at' => now(), 'updated_at' => now()]);
        }

        // ── Notices ─────────────────────────────────────────────
        $notices = [
            ['title'=>'জরুরি বিজ্ঞপ্তি','is_active'=>true,'is_banner'=>false,'sort_order'=>1],
            ['title'=>'২০২৬ সালের ভর্তি বিজ্ঞপ্তি','is_active'=>true,'is_banner'=>true,'sort_order'=>2],
            ['title'=>'২০২৫ সালের ভর্তির বিজ্ঞপ্তি','is_active'=>true,'is_banner'=>false,'sort_order'=>3],
            ['title'=>'২০২৬ সালের ভর্তির বিজ্ঞপ্তি','is_active'=>true,'is_banner'=>false,'sort_order'=>4],
            ['title'=>'২০২৫ সালের ভর্তি বিজ্ঞপ্তি','is_active'=>true,'is_banner'=>false,'sort_order'=>5],
        ];
        foreach ($notices as $n) {
            DB::table('notices')->insert(array_merge($n,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Downloads ───────────────────────────────────────────
        $downloads = [
            ['title'=>'Admission Test Result (Lottery) For Class Six-2021, 2nd Waiting List (SL 43-68)','category'=>'ভর্তি','file'=>'downloads/sample.pdf','is_active'=>true],
            ['title'=>'Admission Test Result (Lottery) For Class Six-2021, 1st Waiting List (SL 01-42)','category'=>'ভর্তি','file'=>'downloads/sample.pdf','is_active'=>true],
            ['title'=>'Admission Test Result (Lottery) 2021 Class Six','category'=>'ভর্তি','file'=>'downloads/sample.pdf','is_active'=>true],
            ['title'=>'Admission test result 2020 Class six','category'=>'ভর্তি','file'=>'downloads/sample.pdf','is_active'=>true],
            ['title'=>'test & half yearly examination 2019','category'=>'পরীক্ষা','file'=>'downloads/sample.pdf','is_active'=>true],
        ];
        foreach ($downloads as $d) {
            DB::table('downloads')->insert(array_merge($d,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── News Ticker ─────────────────────────────────────────
        $news = [
            ['title'=>'চতুর্থ শ্রেণীর এ্যাসাইনমেন্ট প্রক','is_active'=>true],
            ['title'=>'২০২৬ সালের ভর্তি পরীক্ষার ফলাফল প্রকাশিত হয়েছে','is_active'=>true],
            ['title'=>'বার্ষিক ক্রীড়া প্রতিযোগিতা আগামী সপ্তাহে অনুষ্ঠিত হবে','is_active'=>true],
        ];
        foreach ($news as $n) {
            DB::table('news_items')->insert(array_merge($n,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Teachers ────────────────────────────────────────────
        $teachers = [
            ['pds_id'=>'2016303025','name'=>'রোকসানা ফেরদৌস মজুমদার','base_designation'=>'প্রধান শিক্ষিকা','current_designation'=>'প্রধান শিক্ষক','joining_date'=>'2022-11-08','district'=>'হবিগঞ্জ','phone'=>'01912358466','sort_order'=>1],
            ['pds_id'=>'2016706346','name'=>'আবু তৈয়ব মো: হাফিজ উল্যাহ','base_designation'=>'সহ প্রধান শিক্ষক (চঃ দাঃ)','current_designation'=>'সহ প্রধান শিক্ষক (চঃ দাঃ)','joining_date'=>'2017-04-01','district'=>'কুমিল্লা','phone'=>'01716431636','sort_order'=>2],
            ['pds_id'=>'2016706644','name'=>'মো নুরুল ইসলাম','base_designation'=>'সিনিয়র শিক্ষক (বাংলা)','current_designation'=>'সিনিয়র শিক্ষক (বাংলা)','joining_date'=>'2017-12-14','district'=>'কুমিল্লা','phone'=>'01818378611','sort_order'=>3],
            ['pds_id'=>'2016701337','name'=>'জেসমিনা হাসান','base_designation'=>'সিনিয়র শিক্ষক (বাংলা)','current_designation'=>'সিনিয়র শিক্ষক (বাংলা)','joining_date'=>'2006-09-15','district'=>'কুমিল্লা','phone'=>'01816297521','sort_order'=>4],
            ['pds_id'=>'2016706832','name'=>'মোসাম্মৎ শাহীন আক্তার','base_designation'=>'সিনিয়র শিক্ষক (বাংলা)','current_designation'=>'সিনিয়র শিক্ষক (বাংলা)','joining_date'=>'2017-04-01','district'=>'কুমিল্লা','phone'=>'01816658743','sort_order'=>5],
            ['pds_id'=>'2016711540','name'=>'মো মোয়াজ্জেম উদ্দিন','base_designation'=>'সিনিয়র শিক্ষক (ইংরেজি)','current_designation'=>'সিনিয়র শিক্ষক (ইংরেজি)','joining_date'=>'2017-02-19','district'=>'কুমিল্লা','phone'=>'01818079002','sort_order'=>6],
            ['pds_id'=>'2016705856','name'=>'মায়মুদা আখতার','base_designation'=>'সহ শিক্ষক (ইংরেজি)','current_designation'=>'সহ শিক্ষক (ইংরেজি)','joining_date'=>'2025-04-08','district'=>'কুমিল্লা','phone'=>'01828796443','sort_order'=>7],
            ['pds_id'=>'2016701170','name'=>'মোহাম্মদ ইউনুস মোরা','base_designation'=>'সিনিয়র শিক্ষক (গণিত)','current_designation'=>'সিনিয়র শিক্ষক (গণিত)','joining_date'=>'2021-06-30','district'=>'কুমিল্লা','phone'=>'01820084261','sort_order'=>8],
        ];
        foreach ($teachers as $t) {
            DB::table('teachers')->insert(array_merge($t,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Student Data (counts) ───────────────────────────────
        $studentRows = [
            ['class'=>'Six','shift'=>'Morning','section'=>'A','total'=>1,'boys'=>0,'girls'=>1,'muslim'=>1],
            ['class'=>'Six','shift'=>'Day','section'=>'A','total'=>62,'boys'=>35,'girls'=>27,'muslim'=>58,'hindu'=>4],
            ['class'=>'Six','shift'=>'Day','section'=>'B','total'=>58,'boys'=>31,'girls'=>27,'muslim'=>58],
            ['class'=>'Six','shift'=>'Day','section'=>'C','total'=>56,'boys'=>29,'girls'=>27,'muslim'=>56],
            ['class'=>'Seven','shift'=>'Day','section'=>'A','total'=>54,'boys'=>27,'girls'=>27,'muslim'=>47,'hindu'=>7],
            ['class'=>'Seven','shift'=>'Day','section'=>'B','total'=>55,'boys'=>31,'girls'=>24,'muslim'=>55],
            ['class'=>'Seven','shift'=>'Day','section'=>'C','total'=>50,'boys'=>26,'girls'=>24,'muslim'=>50],
            ['class'=>'Eight','shift'=>'Day','section'=>'A','total'=>62,'boys'=>32,'girls'=>30,'muslim'=>56,'hindu'=>5,'ff_general'=>2,'physical'=>1],
            ['class'=>'Eight','shift'=>'Day','section'=>'B','total'=>59,'boys'=>32,'girls'=>27,'muslim'=>59],
            ['class'=>'Eight','shift'=>'Day','section'=>'C','total'=>59,'boys'=>29,'girls'=>30,'muslim'=>58,'physical'=>1],
            ['class'=>'Nine','shift'=>'Day','section'=>'A','total'=>74,'boys'=>25,'girls'=>49,'muslim'=>73,'hindu'=>1,'ff_general'=>1],
            ['class'=>'Nine','shift'=>'Day','section'=>'B','total'=>42,'boys'=>44,'girls'=>44,'muslim'=>41,'ff_general'=>1],
            ['class'=>'Nine','shift'=>'Day','section'=>'C','total'=>50,'boys'=>50,'girls'=>0,'muslim'=>48,'hindu'=>2],
            ['class'=>'Ten','shift'=>'Day','section'=>'A','total'=>49,'boys'=>17,'girls'=>32,'muslim'=>49,'ff_science'=>23,'ff_general'=>26,'physical'=>1],
            ['class'=>'Ten','shift'=>'Day','section'=>'B','total'=>45,'boys'=>46,'girls'=>46,'muslim'=>45,'ff_science'=>46],
            ['class'=>'Ten','shift'=>'Day','section'=>'C','total'=>54,'boys'=>54,'girls'=>0,'muslim'=>54,'ff_science'=>54,'physical'=>3],
        ];
        $defaults = ['hindu'=>0,'buddhist'=>0,'christian'=>0,'ff_science'=>0,'ff_general'=>0,'autistic'=>0,'physical'=>0];
        foreach ($studentRows as $r) {
            DB::table('student_data')->insert(array_merge($defaults,$r,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Sample Students ─────────────────────────────────────
        $sampleStudents = [
            ['roll_no'=>'001','name_bn'=>'মোহাম্মদ রাহিম','name_en'=>'Mohammad Rahim','father_name'=>'আব্দুর রহিম','class'=>'Six','shift'=>'Day','section'=>'A','gender'=>'male','religion'=>'islam','status'=>'active','academic_year'=>date('Y')],
            ['roll_no'=>'002','name_bn'=>'ফাতেমা খাতুন','name_en'=>'Fatema Khatun','father_name'=>'করিম উদ্দিন','class'=>'Six','shift'=>'Day','section'=>'A','gender'=>'female','religion'=>'islam','status'=>'active','academic_year'=>date('Y')],
            ['roll_no'=>'003','name_bn'=>'তানভীর আহমেদ','name_en'=>'Tanvir Ahmed','father_name'=>'জহির আহমেদ','class'=>'Seven','shift'=>'Day','section'=>'B','gender'=>'male','religion'=>'islam','status'=>'active','academic_year'=>date('Y')],
            ['roll_no'=>'004','name_bn'=>'সুমাইয়া বেগম','name_en'=>'Sumaiya Begum','father_name'=>'আলী হোসেন','class'=>'Eight','shift'=>'Day','section'=>'A','gender'=>'female','religion'=>'islam','status'=>'active','academic_year'=>date('Y')],
            ['roll_no'=>'005','name_bn'=>'রাকিব হাসান','name_en'=>'Rakib Hasan','father_name'=>'নুরুল হাসান','class'=>'Nine','shift'=>'Day','section'=>'A','gender'=>'male','religion'=>'islam','status'=>'inactive','academic_year'=>date('Y')],
        ];
        foreach ($sampleStudents as $s) {
            DB::table('students')->insert(array_merge(['mobile'=>'','email'=>null,'address'=>'কুমিল্লা'],$s,['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Sample Exam Results ─────────────────────────────────
        $results = [
            ['title'=>'SSC পরীক্ষার ফলাফল ২০২৪','exam_type'=>'SSC','year'=>2024,'file'=>'results/sample.pdf'],
            ['title'=>'JSC পরীক্ষার ফলাফল ২০২৩','exam_type'=>'JSC','year'=>2023,'file'=>'results/sample.pdf'],
            ['title'=>'বার্ষিক পরীক্ষার ফলাফল ২০২৪','exam_type'=>'Annual','year'=>2024,'file'=>'results/sample.pdf'],
            ['title'=>'অর্ধ-বার্ষিক পরীক্ষার ফলাফল ২০২৪','exam_type'=>'Half_Yearly','year'=>2024,'file'=>'results/sample.pdf'],
            ['title'=>'Admission Test Result (Lottery) For Class Six-2021','exam_type'=>'Admission','year'=>2021,'file'=>'results/sample.pdf'],
        ];
        foreach ($results as $r) {
            DB::table('exam_results')->insert(array_merge($r,['description'=>null,'created_at'=>now(),'updated_at'=>now()]));
        }

        // Color settings (admin-controlled)
        $colorSettings = [
            'color_primary'   => '#1565C0',
            'color_primary_d' => '#0D47A1',
            'color_primary_l' => '#1976D2',
            'color_accent'    => '#E53935',
            'color_green'     => '#2E7D32',
            'color_cyan'      => '#0097A7',
        ];
        foreach ($colorSettings as $k => $v) {
            DB::table('settings')->updateOrInsert(['key' => $k],
                ['key' => $k, 'value' => $v, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
// Note: color settings seeded separately if needed
