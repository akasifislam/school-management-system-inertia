<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-bell"></i> নোটিশ বোর্ড</h3><a href="<?php echo e(route('admin.notices.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন নোটিশ</a></div>
<div class="filter-bar">
<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
<input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="অনুসন্ধান..." style="max-width:230px">
<select name="status" class="form-control" style="max-width:140px"><option value="">সব অবস্থা</option><option value="1" <?php echo e(request('status')=='1'?'selected':''); ?>>সক্রিয়</option><option value="0" <?php echo e(request('status')=='0'?'selected':''); ?>>নিষ্ক্রিয়</option></select>
<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
</form>
</div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>শিরোনাম</th><th>ফাইল</th><th>ব্যানার</th><th>অবস্থা</th><th>তারিখ</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><?php echo e($notices->firstItem()+$i); ?></td>
<td><?php echo e(\Illuminate\Support\Str::limit($n->title,45)); ?></td>
<td><?php if($n->file): ?><a href="<?php echo e(asset('storage/'.$n->file)); ?>" target="_blank" class="btn btn-icon"><i class="fas fa-eye" style="color:#1565C0"></i></a><?php else: ?><span style="color:#bbb;font-size:12px">নেই</span><?php endif; ?></td>
<td><?php if($n->is_banner): ?><span class="badge badge-info">হ্যাঁ</span><?php endif; ?></td>
<td><span class="badge badge-<?php echo e($n->is_active?'success':'danger'); ?>"><?php echo e($n->is_active?'সক্রিয়':'নিষ্ক্রিয়'); ?></span></td>
<td><?php echo e($n->created_at->format('d/m/Y')); ?></td>
<td><div style="display:flex;gap:4px">
<a href="<?php echo e(route('admin.notices.edit',$n)); ?>" class="btn btn-icon edit"><i class="fas fa-edit"></i></a>
<form action="<?php echo e(route('admin.notices.destroy',$n)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="এই নোটিশটি মুছতে চান?"><i class="fas fa-trash"></i></button></form>
</div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7"><div class="empty-state"><i class="fas fa-bell-slash"></i><h3>কোনো নোটিশ নেই</h3><a href="<?php echo e(route('admin.notices.create')); ?>" class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> নোটিশ যোগ করুন</a></div></td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($notices->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/notices_index.blade.php ENDPATH**/ ?>