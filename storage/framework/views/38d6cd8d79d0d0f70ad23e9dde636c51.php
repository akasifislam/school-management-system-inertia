<?php $__env->startSection('content'); ?>
<div class="page-hdr">এক নজরে বিদ্যালয়ের পরিচিতি</div>
<table class="info-tbl">
<tr><td>বিদ্যালয়ের EIIN</td><td><?php echo e($about->eiin ?? '105709'); ?></td></tr>
<tr><td>বিদ্যালয়ের নাম</td><td><?php echo e($about->name_bn ?? 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল'); ?></td></tr>
<tr><td>SCHOOL NAME</td><td><?php echo e($about->name_en ?? 'GOVERNMENT LABORATORY HIGH SCHOOL'); ?></td></tr>
<tr><td>গ্রাম/বাড়ী ও সড়কের বিবরণ</td><td><?php echo e($about->village ?? 'কোটবাড়ী'); ?></td></tr>
<tr><td>ওয়ার্ড নম্বর</td><td><?php echo e($about->ward ?? '২৪'); ?></td></tr>
<tr><td>ইউনিয়ন/পৌরসভা/সিটি কর্পোরেশন</td><td><?php echo e($about->city_corp ?? 'কুমিল্লা সিটি কর্পোরেশন'); ?></td></tr>
<tr><td>পোষ্ট অফিস</td><td><?php echo e($about->post_office ?? 'কোটবাড়ী'); ?></td></tr>
<tr><td>পোষ্ট কোড</td><td><?php echo e($about->post_code ?? '৩৫০০'); ?></td></tr>
<tr><td>পুলিশ স্টেশন</td><td><?php echo e($about->police_station ?? 'কুমিল্লা সদর দক্ষিণ'); ?></td></tr>
<tr><td>উপজেলা</td><td><?php echo e($about->upazila ?? 'সদর দক্ষিণ'); ?></td></tr>
<tr><td>জেলা</td><td><?php echo e($about->district ?? 'কুমিল্লা'); ?></td></tr>
<tr><td>বিভাগ</td><td><?php echo e($about->division ?? 'চট্টগ্রাম'); ?></td></tr>
<tr><td>টেলিফোন</td><td><?php echo e($about->phone ?? '02304430593'); ?></td></tr>
<tr><td>E-Mail</td><td><?php echo e($about->email ?? 'govlabcomilla@gmail.com'); ?></td></tr>
<tr><td>Website</td><td><a href="http://<?php echo e($about->website ?? 'www.govlabcomilla.edu.bd'); ?>" style="color:#1565C0"><?php echo e($about->website ?? 'www.govlabcomilla.edu.bd'); ?></a></td></tr>
<tr><td>শিক্ষার্থীর সংখ্যা</td><td><?php echo e($about->student_count ?? '833'); ?></td></tr>
<tr><td>বিদ্যালয়ের শিফট</td><td><?php echo e($about->shift ?? 'এক শিফট'); ?></td></tr>
<tr><td>বিদ্যালয়ের ধরন</td><td><?php echo e($about->type ?? 'সহশিক্ষা'); ?></td></tr>
<tr><td>মোট জমির পরিমাণ (একর)</td><td><?php echo e($about->land_area ?? '6.36'); ?></td></tr>
<tr><td>ভবন সংখ্যা</td><td><?php echo e($about->buildings ?? '10'); ?></td></tr>
<tr><td>মোট শ্রেণিকক্ষ সংখ্যা</td><td><?php echo e($about->classrooms ?? '21'); ?></td></tr>
<tr><td>মাল্টিমিডিয়া শ্রেণিকক্ষ সংখ্যা</td><td><?php echo e($about->multimedia_rooms ?? '12'); ?></td></tr>
<tr><td>আইসিটি ল্যাব সংখ্যা</td><td><?php echo e($about->ict_labs ?? '1'); ?></td></tr>
<tr><td>বিজ্ঞানাগার এর জন্য কক্ষ সংখ্যা</td><td><?php echo e($about->science_labs ?? '6'); ?></td></tr>
<tr><td>অডিটোরিয়াম আছে কি না</td><td><?php echo e($about->has_auditorium ?? '-'); ?></td></tr>
<tr><td>সীমানা প্রাচীর আছে কি না</td><td><?php echo e($about->has_boundary ?? '-'); ?></td></tr>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\mmdri\Downloads\goblav\resources\views/frontend/pages/about_overview.blade.php ENDPATH**/ ?>