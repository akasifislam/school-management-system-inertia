<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-user-graduate"></i> শিক্ষার্থীর তালিকা (ব্যক্তিগত রেকর্ড)</h3>
<div style="display:flex;gap:8px"><a href="<?php echo e(route('admin.student-records.export')); ?>" class="btn btn-success btn-sm"><i class="fas fa-file-csv"></i> CSV</a><a href="<?php echo e(route('admin.student-records.create')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> নতুন শিক্ষার্থী</a></div></div>
<div class="filter-bar">
<form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
<input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="নাম / রোল / মোবাইল..." style="max-width:200px">
<select name="class" class="form-control" style="max-width:120px"><option value="">সব শ্রেণি</option><?php $__currentLoopData = ['Six','Seven','Eight','Nine','Ten']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>" <?php echo e(request('class')==$c?'selected':''); ?>><?php echo e($c); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
<select name="shift" class="form-control" style="max-width:110px"><option value="">সব শিফট</option><option value="Day" <?php echo e(request('shift')=='Day'?'selected':''); ?>>Day</option><option value="Morning" <?php echo e(request('shift')=='Morning'?'selected':''); ?>>Morning</option></select>
<select name="section" class="form-control" style="max-width:100px"><option value="">সব সেকশন</option><?php $__currentLoopData = ['A','B','C','D','E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($s); ?>" <?php echo e(request('section')==$s?'selected':''); ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>
<select name="status" class="form-control" style="max-width:125px"><option value="">সব অবস্থা</option><option value="active" <?php echo e(request('status')=='active'?'selected':''); ?>>সক্রিয়</option><option value="inactive" <?php echo e(request('status')=='inactive'?'selected':''); ?>>নিষ্ক্রিয়</option><option value="transferred" <?php echo e(request('status')=='transferred'?'selected':''); ?>>ট্রান্সফার</option></select>
<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
<a href="<?php echo e(route('admin.student-records.index')); ?>" class="btn btn-sm" style="background:#f5f7fa;border:1px solid #dde1e9">রিসেট</a>
</form>
<span class="ms-auto" style="font-size:12px;color:#888">মোট: <strong><?php echo e($students->total()); ?></strong></span>
</div>
<div class="admin-table-wrap"><table class="admin-table">
<thead><tr><th>#</th><th>ছবি</th><th>রোল</th><th>নাম</th><th>শ্রেণি/শিফট/সেকশন</th><th>মোবাইল</th><th>অবস্থা</th><th>অ্যাকশন</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><?php echo e($students->firstItem()+$i); ?></td>
<td><?php if($s->photo): ?><img src="<?php echo e(asset('storage/'.$s->photo)); ?>" style="width:38px;height:44px;object-fit:cover;border:1px solid #ddd" alt=""><?php else: ?><div style="width:38px;height:44px;background:#f0f0f0;display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="color:#bbb"></i></div><?php endif; ?></td>
<td style="font-size:12px"><?php echo e($s->roll_no??'—'); ?></td>
<td><strong><?php echo e($s->name_bn); ?></strong><div style="font-size:12px;color:#888"><?php echo e($s->name_en); ?></div></td>
<td style="text-align:center;font-size:12px"><strong><?php echo e($s->class); ?></strong> / <?php echo e($s->shift); ?> / <?php echo e($s->section??'—'); ?></td>
<td style="font-size:12px"><?php echo e($s->mobile??'—'); ?></td>
<td>
<form action="<?php echo e(route('admin.student-records.status',$s)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
<select name="status" class="form-control" style="padding:3px 6px;font-size:11px;min-width:95px" onchange="this.form.submit()">
<option value="active"      <?php echo e($s->status=='active'?'selected':''); ?>>✅ সক্রিয়</option>
<option value="inactive"    <?php echo e($s->status=='inactive'?'selected':''); ?>>❌ নিষ্ক্রিয়</option>
<option value="transferred" <?php echo e($s->status=='transferred'?'selected':''); ?>>🔄 ট্রান্সফার</option>
</select>
</form>
</td>
<td><div style="display:flex;gap:4px">
<a href="<?php echo e(route('admin.student-records.edit',$s)); ?>" class="btn btn-icon edit" title="সম্পাদনা"><i class="fas fa-edit"></i></a>
<button class="btn btn-icon" title="ট্রান্সফার" style="color:#F57F17;border-color:#F57F17" onclick="openTransfer(<?php echo e($s->id); ?>,'<?php echo e(addslashes($s->name_bn)); ?>','<?php echo e($s->class); ?>','<?php echo e($s->shift); ?>','<?php echo e($s->section); ?>')"><i class="fas fa-exchange-alt"></i></button>
<form action="<?php echo e(route('admin.student-records.destroy',$s)); ?>" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="btn btn-icon delete" data-confirm="মুছতে চান?"><i class="fas fa-trash"></i></button></form>
</div></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="8"><div class="empty-state"><i class="fas fa-user-graduate"></i><h3>কোনো শিক্ষার্থী নেই</h3><a href="<?php echo e(route('admin.student-records.create')); ?>" class="btn btn-primary" style="margin-top:12px"><i class="fas fa-plus"></i> যোগ করুন</a></div></td></tr>
<?php endif; ?>
</tbody></table></div>
<div class="pagination-wrap"><?php echo e($students->links()); ?></div>
</div>

<!-- Transfer Modal -->
<div id="transferModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center">
<div style="background:#fff;border-radius:8px;padding:26px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.3)">
<h3 style="font-size:15px;font-weight:700;margin-bottom:4px;color:#1565C0"><i class="fas fa-exchange-alt"></i> শ্রেণি ট্রান্সফার</h3>
<p id="transferStudentName" style="font-size:13px;color:#546E7A;margin-bottom:16px"></p>
<form id="transferForm" method="POST"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
<div class="form-row">
<div class="form-group"><label>নতুন শ্রেণি *</label><select name="class" id="tf_class" class="form-control" required><?php $__currentLoopData = ['Six','Seven','Eight','Nine','Ten']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c); ?>"><?php echo e($c); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
<div class="form-group"><label>শিফট *</label><select name="shift" id="tf_shift" class="form-control" required><option value="Day">Day</option><option value="Morning">Morning</option></select></div>
</div>
<div class="form-group"><label>সেকশন</label><select name="section" id="tf_section" class="form-control"><option value="">নেই</option><?php $__currentLoopData = ['A','B','C','D','E']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($s); ?>"><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
<div class="form-group"><label>নোট</label><textarea name="transfer_note" class="form-control" rows="2"></textarea></div>
<div style="display:flex;gap:10px"><button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> ট্রান্সফার</button><button type="button" class="btn" style="background:#f5f7fa;border:1px solid #dde1e9" onclick="closeTransfer()">বাতিল</button></div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/student_records_index.blade.php ENDPATH**/ ?>