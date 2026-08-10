<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>অ্যাডমিন লগইন - গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
<div class="admin-login-page">
  <div class="login-card">
    <div class="login-logo">
      <i class="fas fa-school"></i>
      <h2>গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</h2>
      <p>অ্যাডমিন প্যানেলে লগইন করুন</p>
    </div>
    <?php if(session('error')): ?>
      <div class="alert alert-error" role="alert"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <form action="<?php echo e(route('admin.login.post')); ?>" method="POST">
    <?php echo csrf_field(); ?>
      <div class="form-group">
        <label><i class="fas fa-envelope"></i> ইমেইল / ব্যবহারকারীর নাম</label>
        <input type="text" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required autofocus placeholder="admin@govlab.edu.bd">
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group">
        <label><i class="fas fa-lock"></i> পাসওয়ার্ড</label>
        <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="••••••••">
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:8px">
        <label style="display:flex;align-items:center;gap:8px;font-weight:400;cursor:pointer">
          <input type="checkbox" name="remember"> মনে রাখুন
        </label>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:11px;font-size:15px">
        <i class="fas fa-sign-in-alt"></i> লগইন করুন
      </button>
    </form>
    <div style="text-align:center;margin-top:18px">
      <a href="<?php echo e(route('home')); ?>" style="color:#1565C0;font-size:13px"><i class="fas fa-arrow-left"></i> ওয়েবসাইটে ফিরে যান</a>
    </div>
  </div>
</div>
</body>
</html>
<?php /**PATH E:\school website\goblav\resources\views/admin/login.blade.php ENDPATH**/ ?>