<?php $__env->startSection('content'); ?>
<div class="page-hdr">অধ্যয়নরত শিক্ষার্থীর সংখ্যা</div>
<form method="GET" action="<?php echo e(route('students.count')); ?>">
<table class="info-tbl">
<tr><td>Academic Year :</td><td><select name="year" class="filter-sel" onchange="this.form.submit()"><?php $__currentLoopData = $academicYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($y); ?>" <?php echo e(request('year',date('Y'))==$y?'selected':''); ?>><?php echo e($y); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td></tr>
<tr><td>Class :</td><td><select name="class" class="filter-sel" onchange="this.form.submit()"><option value="">Select Class</option><?php $__currentLoopData = ['Six','Seven','Eight','Nine','Ten']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>" <?php echo e(request('class')==$c?'selected':''); ?>><?php echo e($c); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td></tr>
<tr><td>Shift :</td><td><select name="shift" class="filter-sel" onchange="this.form.submit()"><option value="">Select Shift</option><option value="Day" <?php echo e(request('shift')=='Day'?'selected':''); ?>>Day</option><option value="Morning" <?php echo e(request('shift')=='Morning'?'selected':''); ?>>Morning</option></select></td></tr>
<tr><td>Section :</td><td><select name="section" class="filter-sel" onchange="this.form.submit()"><option value="">Select Section</option><?php $__currentLoopData = ['A','B','C','D','E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($s); ?>" <?php echo e(request('section')==$s?'selected':''); ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td></tr>
<tr style="background:#E3F2FD"><td colspan="2" style="text-align:center;font-weight:700;color:#1565C0;font-size:14px">Total Students : <?php echo e($totalFiltered); ?></td></tr>
</table>
</form>
<?php if($studentData->count()): ?>
<div style="overflow-x:auto">
<table class="std-tbl">
<thead>
<?php if($hasFilter): ?>
<tr><th>শ্রেণি</th><th>শিফট</th><th>সেকশন</th><th>ছেলে</th><th>মেয়ে</th><th>মোট</th><th>মুসলিম</th><th>হিন্দু</th><th>বৌদ্ধ</th><th>খ্রিষ্টান</th><th>বিজ্ঞান</th><th>সা.সং.</th><th>অটিস্টিক</th><th>শারীরিক</th></tr>
<?php else: ?>
<tr><th rowspan="2">শ্রেণি</th><th rowspan="2">শিফট</th><th rowspan="2">সেকশন</th><th colspan="3">শিক্ষার্থী</th><th colspan="4">ধর্ম</th><th colspan="2">মুক্তিযোদ্ধা</th><th colspan="2">প্রতিবন্ধি</th></tr>
<tr><th>ছেলে</th><th>মেয়ে</th><th>মোট</th><th>মুসলিম</th><th>হিন্দু</th><th>বৌদ্ধ</th><th>খ্রিষ্টান</th><th>বিজ্ঞান</th><th>সা.সং.</th><th>অটিস্টিক</th><th>শারীরিক</th></tr>
<?php endif; ?>
</thead>
<tbody>
<?php $__currentLoopData = $studentData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr><td><?php echo e($r->class); ?></td><td><?php echo e($r->shift); ?></td><td><?php echo e($r->section??'—'); ?></td><td><?php echo e($r->boys); ?></td><td><?php echo e($r->girls); ?></td><td><strong><?php echo e($r->total); ?></strong></td><td><?php echo e($r->muslim); ?></td><td><?php echo e($r->hindu); ?></td><td><?php echo e($r->buddhist); ?></td><td><?php echo e($r->christian); ?></td><td><?php echo e($r->ff_science); ?></td><td><?php echo e($r->ff_general); ?></td><td><?php echo e($r->autistic); ?></td><td><?php echo e($r->physical); ?></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr class="total-row"><td colspan="3"><strong>সর্বমোট</strong></td><td><strong><?php echo e($studentData->sum('boys')); ?></strong></td><td><strong><?php echo e($studentData->sum('girls')); ?></strong></td><td><strong><?php echo e($studentData->sum('total')); ?></strong></td><td><strong><?php echo e($studentData->sum('muslim')); ?></strong></td><td><strong><?php echo e($studentData->sum('hindu')); ?></strong></td><td><strong><?php echo e($studentData->sum('buddhist')); ?></strong></td><td><strong><?php echo e($studentData->sum('christian')); ?></strong></td><td><strong><?php echo e($studentData->sum('ff_science')); ?></strong></td><td><strong><?php echo e($studentData->sum('ff_general')); ?></strong></td><td><strong><?php echo e($studentData->sum('autistic')); ?></strong></td><td><strong><?php echo e($studentData->sum('physical')); ?></strong></td></tr>
</tbody>
</table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/frontend/pages/students_count.blade.php ENDPATH**/ ?>