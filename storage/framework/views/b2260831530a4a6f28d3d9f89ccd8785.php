<?php $__env->startSection('content'); ?>
<div class="stats-grid">
<div class="stat-card"><div class="stat-icon"><i class="fas fa-user-graduate"></i></div><div><div class="stat-value"><?php echo e($stats['students']); ?></div><div class="stat-label">মোট শিক্ষার্থী</div></div></div>
<div class="stat-card red"><div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div><div><div class="stat-value"><?php echo e($stats['teachers']); ?></div><div class="stat-label">শিক্ষক-শিক্ষিকা</div></div></div>
<div class="stat-card green"><div class="stat-icon"><i class="fas fa-bell"></i></div><div><div class="stat-value"><?php echo e($stats['notices']); ?></div><div class="stat-label">সক্রিয় নোটিশ</div></div></div>
<div class="stat-card warn"><div class="stat-icon"><i class="fas fa-file-alt"></i></div><div><div class="stat-value"><?php echo e($stats['admissions']); ?></div><div class="stat-label">অপেক্ষমান আবেদন</div></div></div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-bell"></i> সাম্প্রতিক নোটিশ</h3><a href="<?php echo e(route('admin.notices.index')); ?>" class="btn btn-sm btn-primary">সব দেখুন</a></div>
<div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>শিরোনাম</th><th>তারিখ</th><th>অবস্থা</th></tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $recentNotices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e(\Illuminate\Support\Str::limit($n->title,38)); ?></td><td><?php echo e($n->created_at->format('d/m/Y')); ?></td><td><span class="badge badge-<?php echo e($n->is_active?'success':'danger'); ?>"><?php echo e($n->is_active?'সক্রিয়':'নিষ্ক্রিয়'); ?></span></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="3" style="text-align:center;color:#999;padding:20px">কোনো নোটিশ নেই।</td></tr>
<?php endif; ?>
</tbody></table></div>
</div>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-file-alt"></i> সাম্প্রতিক ভর্তি আবেদন</h3><a href="<?php echo e(route('admin.admissions.index')); ?>" class="btn btn-sm btn-primary">সব দেখুন</a></div>
<div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>নাম</th><th>শ্রেণি</th><th>তারিখ</th><th>অবস্থা</th></tr></thead><tbody>
<?php $__empty_1 = true; $__currentLoopData = $recentAdmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($a->name_bn); ?></td><td><?php echo e($a->applying_class); ?></td><td><?php echo e($a->created_at->format('d/m/Y')); ?></td><td><span class="badge badge-<?php echo e($a->status==='approved'?'success':($a->status==='rejected'?'danger':'warning')); ?>"><?php echo e($a->status==='approved'?'অনুমোদিত':($a->status==='rejected'?'বাতিল':'অপেক্ষমান')); ?></span></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="4" style="text-align:center;color:#999;padding:20px">কোনো আবেদন নেই।</td></tr>
<?php endif; ?>
</tbody></table></div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/dashboard.blade.php ENDPATH**/ ?>