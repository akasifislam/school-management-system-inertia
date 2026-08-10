<?php $__env->startSection('content'); ?>
<div class="page-hdr">কর্মরত শিক্ষক-শিক্ষিকা</div>
<div style="overflow-x:auto">
<table class="teacher-tbl">
<thead><tr><th>#</th><th>ছবি</th><th>পিডিএস আইডি / নাম</th><th>বর্তমান পদবী</th><th>যোগদান</th><th>জেলা</th><th>মোবাইল</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td style="text-align:center"><?php echo e($i+1); ?></td>
<td><?php if($t->photo): ?><img src="<?php echo e(asset('storage/'.$t->photo)); ?>" class="teacher-photo-sm" alt=""><?php else: ?><div style="width:44px;height:50px;background:#f0f0f0;display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="color:#bbb"></i></div><?php endif; ?></td>
<td><div style="font-size:11px;color:#888"><?php echo e($t->pds_id); ?></div><strong><?php echo e($t->name); ?></strong><div style="font-size:11px;color:#888"><?php echo e($t->base_designation); ?></div></td>
<td><?php echo e($t->current_designation); ?></td>
<td style="white-space:nowrap"><?php echo e($t->joining_date?->format('d.m.Y')); ?></td>
<td><?php echo e($t->district); ?></td>
<td><?php echo e($t->phone); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="7" style="text-align:center;padding:30px;color:#999">কোনো তথ্য নেই।</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/frontend/pages/information.blade.php ENDPATH**/ ?>