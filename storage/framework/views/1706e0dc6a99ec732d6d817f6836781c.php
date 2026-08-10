<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-download"></i> ডাউনলোডস</h3><a href="<?php echo e(route('admin.downloads.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন ফাইল</a></div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>শিরোনাম</th><th>বিভাগ</th><th>ফাইল</th><th>অবস্থা</th><th>তারিখ</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $downloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($downloads->firstItem()+$i); ?></td><td><?php echo e(\Illuminate\Support\Str::limit($d->title,40)); ?></td><td><?php echo e($d->category??'-'); ?></td>
<td><a href="<?php echo e(asset('storage/'.$d->file)); ?>" target="_blank" class="btn btn-icon"><i class="fas fa-eye" style="color:#1565C0"></i></a></td>
<td><span class="badge badge-<?php echo e($d->is_active?'success':'danger'); ?>"><?php echo e($d->is_active?'সক্রিয়':'নিষ্ক্রিয়'); ?></span></td>
<td><?php echo e($d->created_at->format('d/m/Y')); ?></td>
<td><div style="display:flex;gap:4px"><a href="<?php echo e(route('admin.downloads.edit',$d)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a><form action="<?php echo e(route('admin.downloads.destroy',$d)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7"><div class="empty-state"><i class="fas fa-folder-open"></i><h3>কোনো ফাইল নেই</h3></div></td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($downloads->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/downloads_index.blade.php ENDPATH**/ ?>