<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-image"></i> <?php echo e(isset($image)?'ছবি সম্পাদনা':'নতুন ছবি যোগ করুন'); ?></h3><a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-sm" style="background:#f5f7fa;border:1px solid #dde1e9"><i class="fas fa-arrow-left"></i> ফিরে যান</a></div>
<div class="card-body">
<form action="<?php echo e(isset($image)?route('admin.gallery.update',$image):route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php if(isset($image)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
<div style="display:flex;gap:20px;align-items:flex-start">
<div><?php if(isset($image)&&$image->image): ?><img src="<?php echo e(asset('storage/'.$image->image)); ?>" style="width:150px;height:120px;object-fit:cover;border:1px solid #dde1e9;border-radius:6px;margin-bottom:8px" alt=""><?php endif; ?>
<input type="file" name="image" class="form-control" accept="image/*" <?php echo e(isset($image)?'':'required'); ?>></div>
<div style="flex:1">
<div class="form-group"><label>ক্যাপশন</label><input type="text" name="caption" class="form-control" value="<?php echo e(old('caption',$image->caption??'')); ?>"></div>
<div class="form-group"><label>ক্রমিক নম্বর</label><input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order',$image->sort_order??0)); ?>"></div>
</div>
</div>
<div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> সংরক্ষণ</button><a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn" style="background:#f5f7fa;border:1px solid #dde1e9">বাতিল</a></div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/gallery_form.blade.php ENDPATH**/ ?>