<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-newspaper"></i> নোটিশ (টিকার/স্ক্রোল)</h3><a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন খবর</a></div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>শিরোনাম</th><th>লিংক</th><th>অবস্থা</th><th>তারিখ</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($news->firstItem()+$i); ?></td><td><?php echo e(\Illuminate\Support\Str::limit($item->title,50)); ?></td><td><?php echo e($item->link?'আছে':'নেই'); ?></td>
<td><span class="badge badge-<?php echo e($item->is_active?'success':'danger'); ?>"><?php echo e($item->is_active?'সক্রিয়':'নিষ্ক্রিয়'); ?></span></td>
<td><?php echo e($item->created_at->format('d/m/Y')); ?></td>
<td><div style="display:flex;gap:4px"><a href="<?php echo e(route('admin.news.edit',$item)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a><form action="<?php echo e(route('admin.news.destroy',$item)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form></div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" style="text-align:center;padding:30px;color:#999">কোনো খবর নেই।</td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($news->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/news_index.blade.php ENDPATH**/ ?>