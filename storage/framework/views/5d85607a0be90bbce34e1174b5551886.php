<?php $__env->startSection('content'); ?>
<div class="page-hdr">ছবির গ্যালারী</div>
<div class="gallery-grid">
<?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="gallery-item" onclick="openLightbox('<?php echo e(asset('storage/'.$img->image)); ?>','<?php echo e($img->caption); ?>')">
<img src="<?php echo e(asset('storage/'.$img->image)); ?>" alt="<?php echo e($img->caption??'Gallery'); ?>" loading="lazy">
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div style="grid-column:1/-1;text-align:center;padding:40px;color:#999">কোনো ছবি নেই।</div>
<?php endif; ?>
</div>
<?php if($images->hasPages()): ?><div style="padding:12px 14px;border-top:1px solid #eee"><?php echo e($images->links()); ?></div><?php endif; ?>
<!-- Lightbox -->
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;align-items:center;justify-content:center;flex-direction:column" role="dialog" aria-modal="true">
<button onclick="closeLightbox()" style="position:absolute;top:20px;right:20px;background:transparent;border:none;color:#fff;font-size:32px;cursor:pointer;line-height:1" aria-label="Close">&times;</button>
<img id="lbImg" style="max-width:92vw;max-height:82vh;object-fit:contain" alt="">
<p id="lbCap" style="color:#fff;margin-top:10px;font-size:14px"></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/frontend/pages/gallery.blade.php ENDPATH**/ ?>