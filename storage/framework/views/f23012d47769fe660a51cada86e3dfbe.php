<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-cog"></i> পেজ সম্পাদনা (principal)</h3></div>
<div class="card-body"><p style="color:#888;font-size:13px">এই পেজের কন্টেন্ট Config পেজ থেকে সম্পাদনা করুন।</p><a href="<?php echo e(route('admin.config')); ?>#section-principal" class="btn btn-primary" style="margin-top:12px"><i class="fas fa-sliders-h"></i> Config পেজে যান</a></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/principal.blade.php ENDPATH**/ ?>