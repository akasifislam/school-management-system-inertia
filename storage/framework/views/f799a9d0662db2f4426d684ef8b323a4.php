<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-chart-bar"></i> শিক্ষার্থীর সংখ্যা ব্যবস্থাপনা</h3><a href="<?php echo e(route('admin.students.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন রেকর্ড</a></div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>শ্রেণি</th><th>শিফট</th><th>সেকশন</th><th>ছেলে</th><th>মেয়ে</th><th>মোট</th><th>মুসলিম</th><th>হিন্দু</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $studentData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($r->class); ?></td><td><?php echo e($r->shift); ?></td><td><?php echo e($r->section??'—'); ?></td><td><?php echo e($r->boys); ?></td><td><?php echo e($r->girls); ?></td><td><strong><?php echo e($r->total); ?></strong></td><td><?php echo e($r->muslim); ?></td><td><?php echo e($r->hindu); ?></td>
<td><div style="display:flex;gap:4px"><a href="<?php echo e(route('admin.students.edit',$r)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a><form action="<?php echo e(route('admin.students.destroy',$r)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="9"><div class="empty-state"><i class="fas fa-chart-bar"></i><h3>কোনো রেকর্ড নেই</h3><a href="<?php echo e(route('admin.students.create')); ?>" class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> রেকর্ড যোগ করুন</a></div></td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($studentData->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/students_index.blade.php ENDPATH**/ ?>