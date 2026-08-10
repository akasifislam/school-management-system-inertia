<?php $__env->startSection('content'); ?>
<div class="page-hdr">অধ্যয়নরত শিক্ষার্থীর তালিকা</div>
<form method="GET" action="<?php echo e(route('students.list')); ?>" class="filter-row" style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr auto;gap:8px;padding:12px 14px;background:#f8f9fa;border-bottom:1px solid #e0e0e0">
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">শ্রেণি</label><select name="class" class="filter-sel" style="width:100%"><option value="">সব শ্রেণি</option><?php $__currentLoopData = ['Six','Seven','Eight','Nine','Ten']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>" <?php echo e(request('class')==$c?'selected':''); ?>><?php echo e($c); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">শিফট</label><select name="shift" class="filter-sel" style="width:100%"><option value="">সব শিফট</option><option value="Day" <?php echo e(request('shift')=='Day'?'selected':''); ?>>Day</option><option value="Morning" <?php echo e(request('shift')=='Morning'?'selected':''); ?>>Morning</option></select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">সেকশন</label><select name="section" class="filter-sel" style="width:100%"><option value="">সব সেকশন</option><?php $__currentLoopData = ['A','B','C','D','E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($s); ?>" <?php echo e(request('section')==$s?'selected':''); ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
<div><label style="font-size:11px;font-weight:700;color:#546E7A;display:block;margin-bottom:3px">নাম / রোল</label><input type="text" name="search" value="<?php echo e(request('search')); ?>" class="filter-sel" style="width:100%" placeholder="নাম বা রোল..."></div>
<div style="align-self:flex-end"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button></div>
</form>
<div style="padding:7px 14px;background:#fff;border-bottom:1px solid #eee;font-size:12px;color:#546E7A">মোট: <strong style="color:#1565C0"><?php echo e($students->total()); ?></strong></div>
<div style="overflow-x:auto">
<table class="list-tbl">
<thead><tr><th>#</th><th>রোল</th><th>নাম (বাংলায়)</th><th>নাম (ইংরেজিতে)</th><th>শ্রেণি</th><th>শিফট</th><th>সেকশন</th><th>লিঙ্গ</th><th>অবস্থা</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr><td><?php echo e($students->firstItem()+$i); ?></td><td><?php echo e($s->roll_no??'—'); ?></td><td><strong><?php echo e($s->name_bn); ?></strong></td><td style="color:#888;font-size:12px"><?php echo e($s->name_en); ?></td><td><?php echo e($s->class); ?></td><td><?php echo e($s->shift); ?></td><td><?php echo e($s->section??'—'); ?></td><td><?php echo e($s->gender=='male'?'ছেলে':'মেয়ে'); ?></td><td><span class="<?php echo e($s->status=='active'?'badge-act':'badge-ina'); ?>"><?php echo e($s->status=='active'?'সক্রিয়':'নিষ্ক্রিয়'); ?></span></td></tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="9" style="text-align:center;padding:40px;color:#999"><i class="fas fa-user-graduate" style="font-size:30px;display:block;margin-bottom:10px;opacity:.3"></i>কোনো শিক্ষার্থী পাওয়া যায়নি।</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
<?php if($students->hasPages()): ?><div style="padding:12px 14px;border-top:1px solid #eee"><?php echo e($students->appends(request()->all())->links()); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\mmdri\Downloads\goblav\resources\views/frontend/pages/students_list.blade.php ENDPATH**/ ?>