<?php $__env->startSection('content'); ?>
<div class="admin-card">
<div class="card-header"><h3><i class="fas fa-cog"></i> সাইট সেটিংস</h3></div>
<div class="card-body">
<form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

<h4 style="font-size:13px;font-weight:700;color:#1565C0;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid #eef0f4"><i class="fas fa-school"></i> বিদ্যালয়ের তথ্য</h4>
<div class="form-row"><div class="form-group"><label>বিদ্যালয়ের নাম (বাংলা)</label><input type="text" name="school_name_bn" class="form-control" value="<?php echo e(old('school_name_bn',$settings['school_name_bn']??'')); ?>"></div><div class="form-group"><label>School Name (English)</label><input type="text" name="school_name_en" class="form-control" value="<?php echo e(old('school_name_en',$settings['school_name_en']??'')); ?>"></div></div>
<div class="form-row"><div class="form-group"><label>ফোন নম্বর</label><input type="text" name="phone" class="form-control" value="<?php echo e(old('phone',$settings['phone']??'')); ?>"></div><div class="form-group"><label>ইমেইল</label><input type="email" name="email" class="form-control" value="<?php echo e(old('email',$settings['email']??'')); ?>"></div></div>
<div class="form-group"><label>ওয়েবসাইট</label><input type="text" name="website" class="form-control" value="<?php echo e(old('website',$settings['website']??'')); ?>"></div>

<h4 style="font-size:13px;font-weight:700;color:#1565C0;margin:20px 0 12px;padding-bottom:6px;border-bottom:1px solid #eef0f4"><i class="fas fa-image"></i> লোগো ও ব্যানার</h4>
<div class="form-row">
<div class="form-group"><label>স্কুলের লোগো</label><?php if(!empty($settings['logo'])): ?><img src="<?php echo e(asset('storage/'.$settings['logo'])); ?>" style="width:80px;height:80px;object-fit:contain;display:block;border:1px solid #dde1e9;margin-bottom:8px"><?php endif; ?><input type="file" name="logo" class="form-control" accept="image/*" data-preview="lgPrev"><img id="lgPrev" style="display:none;width:80px;height:80px;object-fit:contain;margin-top:8px;border:1px solid #dde1e9" alt=""></div>
<div class="form-group"><label>হেডার ব্যানার (প্রশস্ত ছবি, 1100×130 px প্রস্তাবিত)</label><?php if(!empty($settings['banner'])): ?><img src="<?php echo e(asset('storage/'.$settings['banner'])); ?>" style="width:100%;max-width:280px;height:65px;object-fit:cover;display:block;border:1px solid #dde1e9;margin-bottom:8px"><?php endif; ?><input type="file" name="banner" class="form-control" accept="image/*" data-preview="bnPrev"><img id="bnPrev" style="display:none;width:100%;max-width:280px;height:65px;object-fit:cover;margin-top:8px;border:1px solid #dde1e9" alt=""></div>
</div>

<h4 style="font-size:13px;font-weight:700;color:#1565C0;margin:20px 0 12px;padding-bottom:6px;border-bottom:1px solid #eef0f4"><i class="fas fa-palette"></i> রঙ নিয়ন্ত্রণ (Color Settings)</h4>
<p style="font-size:12px;color:#888;margin-bottom:14px">এই রঙগুলো পরিবর্তন করলে পুরো ওয়েবসাইটের রঙ পরিবর্তন হবে।</p>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px">

  <div class="form-group">
    <label>প্রাথমিক রঙ (Primary Color)</label>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="color" name="color_primary" value="<?php echo e($settings['color_primary']??'#1565C0'); ?>"
             style="width:48px;height:36px;padding:2px;border:1px solid #dde1e9;border-radius:4px;cursor:pointer"
             onchange="document.getElementById('cp_primary').value=this.value">
      <input type="text" id="cp_primary" class="form-control" value="<?php echo e($settings['color_primary']??'#1565C0'); ?>" style="max-width:110px;font-size:12px"
             onchange="this.previousElementSibling.value=this.value" name="color_primary_text" readonly>
    </div>
    <small style="color:#888;font-size:11px">নেভিগেশন ও হেডার</small>
  </div>

  <div class="form-group">
    <label>গাঢ় প্রাথমিক (Primary Dark)</label>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="color" name="color_primary_d" value="<?php echo e($settings['color_primary_d']??'#0D47A1'); ?>"
             style="width:48px;height:36px;padding:2px;border:1px solid #dde1e9;border-radius:4px;cursor:pointer">
      <span style="font-size:12px;color:#888"><?php echo e($settings['color_primary_d']??'#0D47A1'); ?></span>
    </div>
    <small style="color:#888;font-size:11px">হোভার ও অ্যাক্টিভ স্টেট</small>
  </div>

  <div class="form-group">
    <label>অ্যাকসেন্ট রঙ (Accent - Red)</label>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="color" name="color_accent" value="<?php echo e($settings['color_accent']??'#E53935'); ?>"
             style="width:48px;height:36px;padding:2px;border:1px solid #dde1e9;border-radius:4px;cursor:pointer">
      <span style="font-size:12px;color:#888"><?php echo e($settings['color_accent']??'#E53935'); ?></span>
    </div>
    <small style="color:#888;font-size:11px">বুলেট পয়েন্ট ও লিংক</small>
  </div>

  <div class="form-group">
    <label>সবুজ রঙ (Green)</label>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="color" name="color_green" value="<?php echo e($settings['color_green']??'#2E7D32'); ?>"
             style="width:48px;height:36px;padding:2px;border:1px solid #dde1e9;border-radius:4px;cursor:pointer">
      <span style="font-size:12px;color:#888"><?php echo e($settings['color_green']??'#2E7D32'); ?></span>
    </div>
    <small style="color:#888;font-size:11px">ওয়েব মাস্টার উইজেট</small>
  </div>

  <div class="form-group">
    <label>সায়ান রঙ (Cyan - Download)</label>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="color" name="color_cyan" value="<?php echo e($settings['color_cyan']??'#0097A7'); ?>"
             style="width:48px;height:36px;padding:2px;border:1px solid #dde1e9;border-radius:4px;cursor:pointer">
      <span style="font-size:12px;color:#888"><?php echo e($settings['color_cyan']??'#0097A7'); ?></span>
    </div>
    <small style="color:#888;font-size:11px">ডাউনলোড আইকন</small>
  </div>

  <div class="form-group">
    <label>লাইভ প্রিভিউ</label>
    <div style="padding:10px;border:1px solid #dde1e9;border-radius:6px;background:#f8f9fa">
      <div style="background:<?php echo e($settings['color_primary']??'#1565C0'); ?>;color:#fff;padding:5px 10px;font-size:12px;border-radius:3px;margin-bottom:5px">নেভিগেশন বার</div>
      <div style="background:<?php echo e($settings['color_green']??'#2E7D32'); ?>;color:#fff;padding:5px 10px;font-size:12px;border-radius:3px;margin-bottom:5px">সবুজ উইজেট</div>
      <span style="color:<?php echo e($settings['color_accent']??'#E53935'); ?>;font-size:12px;font-weight:700">► অ্যাকসেন্ট রঙ</span>
    </div>
  </div>

</div>

<div class="form-actions"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> সেটিংস সংরক্ষণ করুন</button></div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/admin/pages/settings.blade.php ENDPATH**/ ?>