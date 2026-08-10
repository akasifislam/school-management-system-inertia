<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-poll"></i> পরীক্ষার ফলাফল</h3><a href="<?php echo e(route('admin.results.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন ফলাফল</a></div>
<div class="filter-bar">
<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
<input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="খুঁজুন..." style="max-width:200px">
<select name="year" class="form-control" style="max-width:120px"><option value="">সব বছর</option><?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($y); ?>" <?php echo e(request('year')==$y?'selected':''); ?>><?php echo e($y); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
<select name="exam_type" class="form-control" style="max-width:140px"><option value="">সব ধরন</option><?php $__currentLoopData = ['JSC','SSC','Half_Yearly','Annual','Admission']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($t); ?>" <?php echo e(request('exam_type')==$t?'selected':''); ?>><?php echo e($t); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
</form>
</div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>শিরোনাম</th><th>পরীক্ষা</th><th>বছর</th><th>ফাইল</th><th>তারিখ</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($results->firstItem()+$i); ?></td><td><?php echo e(\Illuminate\Support\Str::limit($r->title,40)); ?></td><td><span class="badge badge-info"><?php echo e($r->exam_type); ?></span></td><td><?php echo e($r->year); ?></td>
<td><a href="<?php echo e(asset('storage/'.$r->file)); ?>" target="_blank" class="btn btn-icon"><i class="fas fa-eye" style="color:#1565C0"></i></a></td>
<td><?php echo e($r->created_at->format('d/m/Y')); ?></td>
<td><div style="display:flex;gap:4px"><a href="<?php echo e(route('admin.results.edit',$r)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a><form action="<?php echo e(route('admin.results.destroy',$r)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" style="text-align:center;padding:30px;color:#999">কোনো ফলাফল নেই।</td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($results->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/results_index.blade.php ENDPATH**/ ?>