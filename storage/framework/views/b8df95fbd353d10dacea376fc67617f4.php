<?php $__env->startSection('content'); ?>
<div class="page-hdr">যোগাযোগ</div>
<table class="info-tbl">
<tr><td>বিদ্যালয়ের নাম</td><td>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</td></tr>
<tr><td>গ্রাম/বাড়ী ও সড়কের বিবরণ</td><td><?php echo e($contact->village??'কোটবাড়ী'); ?></td></tr>
<tr><td>ওয়ার্ড নম্বর</td><td><?php echo e($contact->ward??'২৪'); ?></td></tr>
<tr><td>ইউনিয়ন/পৌরসভা/সিটি কর্পোরেশন</td><td><?php echo e($contact->city_corp??'কুমিল্লা সিটি কর্পোরেশন'); ?></td></tr>
<tr><td>পোষ্ট অফিস</td><td><?php echo e($contact->post_office??'কোটবাড়ী'); ?></td></tr>
<tr><td>পোষ্ট কোড</td><td><?php echo e($contact->post_code??'৩৫০০'); ?></td></tr>
<tr><td>পুলিশ স্টেশন</td><td><?php echo e($contact->police_station??'কুমিল্লা সদর দক্ষিণ'); ?></td></tr>
<tr><td>উপজেলা</td><td><?php echo e($contact->upazila??'সদর দক্ষিণ'); ?></td></tr>
<tr><td>জেলা</td><td><?php echo e($contact->district??'কুমিল্লা'); ?></td></tr>
<tr><td>বিভাগ</td><td><?php echo e($contact->division??'চট্টগ্রাম'); ?></td></tr>
<tr><td>টেলিফোন</td><td><?php echo e($contact->phone??'02304430593'); ?></td></tr>
<tr><td>E-Mail</td><td><?php echo e($contact->email??'govlabcomilla@gmail.com'); ?></td></tr>
<tr><td>Website</td><td><a href="http://<?php echo e($contact->website??'www.govlabcomilla.edu.bd'); ?>" style="color:#1565C0"><?php echo e($contact->website??'www.govlabcomilla.edu.bd'); ?></a></td></tr>
</table>
<?php if(!empty($contact->map_embed)): ?><div style="padding:15px"><?php echo $contact->map_embed; ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/frontend/pages/contact.blade.php ENDPATH**/ ?>