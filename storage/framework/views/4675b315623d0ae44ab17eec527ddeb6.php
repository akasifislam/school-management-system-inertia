<?php $__env->startSection('content'); ?>
<div class="page-hdr">পরীক্ষার ফলাফল</div>
<div class="result-tabs">
<?php $types=['সব'=>'','JSC'=>'JSC','SSC'=>'SSC','অর্ধ-বার্ষিক'=>'Half_Yearly','বার্ষিক'=>'Annual','ভর্তি'=>'Admission']; ?>
<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e(route('results',array_merge(request()->only(['year','search']),['exam_type'=>$val]))); ?>" class="result-tab <?php echo e(request('exam_type')===$val?'active':''); ?>"><?php echo e($label); ?></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="result-filter">
<form method="GET">
<?php if(request('exam_type')): ?><input type="hidden" name="exam_type" value="<?php echo e(request('exam_type')); ?>"><?php endif; ?>
<div><label class="form-group">বছর</label><select name="year" class="form-ctrl"><option value="">সব বছর</option><?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($y); ?>" <?php echo e(request('year')==$y?'selected':''); ?>><?php echo e($y); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
<div><label class="form-group">অনুসন্ধান</label><input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-ctrl" placeholder="ফলাফলের শিরোনাম..."></div>
<div style="display:flex;gap:6px;align-items:flex-end"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button><a href="<?php echo e(route('results')); ?>" class="btn btn-sm" style="background:#f5f5f5;border:1px solid #ddd;color:#555">রিসেট</a></div>
</form>
</div>
<div style="padding:14px">
<?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="result-card">
<div style="flex:1">
<div class="result-card-title"><?php echo e($r->title); ?></div>
<div class="result-card-meta"><span class="exam-badge"><?php echo e($r->exam_type); ?></span><span><i class="fas fa-calendar-alt" style="color:#1565C0;margin-right:3px"></i><?php echo e($r->year); ?></span><?php if($r->description): ?><span><?php echo e(\Illuminate\Support\Str::limit($r->description,60)); ?></span><?php endif; ?></div>
</div>
<div style="display:flex;gap:6px;flex-shrink:0">
<a href="<?php echo e(asset('storage/'.$r->file)); ?>" target="_blank" style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:#E3F2FD;color:#1565C0;border-radius:4px;font-size:12px;font-weight:700;border:1px solid #90CAF9"><i class="fas fa-eye"></i> দেখুন</a>
<a href="<?php echo e(asset('storage/'.$r->file)); ?>" download style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;background:#1565C0;color:#fff;border-radius:4px;font-size:12px;font-weight:700"><i class="fas fa-download"></i> ডাউনলোড</a>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="empty-state"><i class="fas fa-inbox"></i><h3>কোনো ফলাফল পাওয়া যায়নি।</h3><a href="<?php echo e(route('results')); ?>" style="color:#1565C0;font-size:13px">সব ফলাফল দেখুন</a></div>
<?php endif; ?>
</div>
<?php if($results->hasPages()): ?><div style="padding:10px 14px;border-top:1px solid #eee;display:flex;justify-content:center"><?php echo e($results->appends(request()->all())->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\mmdri\Downloads\goblav\resources\views/frontend/pages/results.blade.php ENDPATH**/ ?>