<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-chalkboard-teacher"></i> শিক্ষক তালিকা</h3><a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন শিক্ষক</a></div>
<div class="filter-bar"><form method="GET" style="display:flex;gap:8px"><input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="নাম বা পিডিএস আইডি..." style="max-width:280px"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></form></div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>ছবি</th><th>পিডিএস আইডি</th><th>নাম</th><th>বর্তমান পদবী</th><th>মোবাইল</th><th>জেলা</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><?php echo e($teachers->firstItem()+$i); ?></td>
<td><?php if($t->photo): ?><img src="<?php echo e(asset('storage/'.$t->photo)); ?>" class="teacher-thumb" alt=""><?php else: ?><div style="width:44px;height:50px;background:#f0f0f0;display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="color:#bbb"></i></div><?php endif; ?></td>
<td style="font-size:12px;color:#888"><?php echo e($t->pds_id); ?></td>
<td><strong><?php echo e($t->name); ?></strong><div style="font-size:12px;color:#888"><?php echo e($t->base_designation); ?></div></td>
<td><?php echo e($t->current_designation); ?></td>
<td><?php echo e($t->phone); ?></td>
<td><?php echo e($t->district); ?></td>
<td><div style="display:flex;gap:4px"><a href="<?php echo e(route('admin.teachers.edit',$t)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a><form action="<?php echo e(route('admin.teachers.destroy',$t)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="8"><div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><h3>কোনো শিক্ষক নেই</h3><a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> শিক্ষক যোগ করুন</a></div></td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($teachers->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/teachers_index.blade.php ENDPATH**/ ?>