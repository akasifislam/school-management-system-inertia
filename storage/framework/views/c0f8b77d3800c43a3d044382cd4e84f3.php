<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e($title ?? 'অ্যাডমিন প্যানেল'); ?> - গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="admin-body">

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar" role="navigation" aria-label="Admin navigation">
  <div class="sidebar-header">
    <div class="sidebar-logo">
      <i class="fas fa-school"></i>
      <div><span class="sidebar-title">গভর্নমেন্ট ল্যাব</span><span class="sidebar-subtitle">অ্যাডমিন প্যানেল</span></div>
    </div>
    <button class="sidebar-close" id="sidebarClose" aria-label="Close sidebar"><i class="fas fa-times"></i></button>
  </div>
  <nav class="sidebar-nav">

    <div class="nav-section">
      <span class="nav-section-label">ড্যাশবোর্ড</span>
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.dashboard')?'active':''); ?>"><i class="fas fa-tachometer-alt"></i><span>ড্যাশবোর্ড</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">কনফিগারেশন</span>
      <a href="<?php echo e(route('admin.config')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.config')?'active':''); ?>"><i class="fas fa-sliders-h"></i><span>সম্পূর্ণ কনফিগ</span></a>
      <a href="<?php echo e(route('admin.settings')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.settings')?'active':''); ?>"><i class="fas fa-cog"></i><span>সাইট সেটিংস</span></a>
      <a href="<?php echo e(route('admin.principal')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.principal')?'active':''); ?>"><i class="fas fa-user-tie"></i><span>প্রধান শিক্ষক</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">কন্টেন্ট</span>
      <a href="<?php echo e(route('admin.notices.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.notices*')?'active':''); ?>"><i class="fas fa-bell"></i><span>নোটিশ বোর্ড</span></a>
      <a href="<?php echo e(route('admin.news.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.news*')?'active':''); ?>"><i class="fas fa-newspaper"></i><span>নোটিশ (টিকার)</span></a>
      <a href="<?php echo e(route('admin.downloads.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.downloads*')?'active':''); ?>"><i class="fas fa-download"></i><span>ডাউনলোডস</span></a>
      <a href="<?php echo e(route('admin.gallery.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.gallery*')?'active':''); ?>"><i class="fas fa-images"></i><span>ছবির গ্যালারী</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">বিদ্যালয় তথ্য</span>
      <a href="<?php echo e(route('admin.about')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.about')?'active':''); ?>"><i class="fas fa-info-circle"></i><span>বিদ্যালয় পরিচিতি</span></a>
      <a href="<?php echo e(route('admin.teachers.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.teachers*')?'active':''); ?>"><i class="fas fa-chalkboard-teacher"></i><span>শিক্ষক তালিকা</span></a>
      <a href="<?php echo e(route('admin.students.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.students.index')?'active':''); ?>"><i class="fas fa-chart-bar"></i><span>শিক্ষার্থীর সংখ্যা</span></a>
      <a href="<?php echo e(route('admin.student-records.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.student-records*')?'active':''); ?>"><i class="fas fa-user-graduate"></i><span>শিক্ষার্থীর তালিকা</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">পরীক্ষা ও ভর্তি</span>
      <a href="<?php echo e(route('admin.results.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.results*')?'active':''); ?>"><i class="fas fa-poll"></i><span>পরীক্ষার ফলাফল</span></a>
      <a href="<?php echo e(route('admin.admissions.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.admissions*')?'active':''); ?>"><i class="fas fa-file-alt"></i><span>ভর্তি আবেদন</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">পেজ কন্টেন্ট</span>
      <a href="<?php echo e(route('admin.apa')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.apa')?'active':''); ?>"><i class="fas fa-chart-bar"></i><span>এপিএ</span></a>
      <a href="<?php echo e(route('admin.sudhachar')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.sudhachar')?'active':''); ?>"><i class="fas fa-star"></i><span>সুধাচার কৌশল</span></a>
      <a href="<?php echo e(route('admin.history')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.history')?'active':''); ?>"><i class="fas fa-history"></i><span>সংক্ষিপ্ত ইতিহাস</span></a>
      <a href="<?php echo e(route('admin.contact')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.contact')?'active':''); ?>"><i class="fas fa-envelope"></i><span>যোগাযোগ তথ্য</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">রক্ষণাবেক্ষণ</span>
      <a href="<?php echo e(route('admin.maintenance')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.maintenance') ? 'active':''); ?>"><i class="fas fa-tools"></i><span>মেইনটেন্যান্স</span></a>
      <a href="<?php echo e(route('admin.site-controls')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.site-controls') ? 'active':''); ?>"><i class="fas fa-toggle-on"></i><span>সাইট কন্ট্রোল</span></a>
      <a href="<?php echo e(route('admin.announcements.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.announcements*') ? 'active':''); ?>"><i class="fas fa-bullhorn"></i><span>ঘোষণা / Popup</span></a>
      <a href="<?php echo e(route('admin.activity-logs')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.activity-logs') ? 'active':''); ?>"><i class="fas fa-list-alt"></i><span>অ্যাক্টিভিটি লগ</span></a>
      <a href="<?php echo e(route('admin.backup')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.backup') ? 'active':''); ?>"><i class="fas fa-database"></i><span>ব্যাকআপ</span></a>
      <a href="<?php echo e(route('admin.system-info')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.system-info') ? 'active':''); ?>"><i class="fas fa-server"></i><span>সিস্টেম তথ্য</span></a>
    </div>

    <div class="nav-section">
      <span class="nav-section-label">অ্যাকাউন্ট</span>
      <a href="<?php echo e(route('home')); ?>" target="_blank" class="nav-item"><i class="fas fa-external-link-alt"></i><span>ওয়েবসাইট দেখুন</span></a>
      <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="nav-form"><?php echo csrf_field(); ?>
        <button type="submit" class="nav-item nav-btn"><i class="fas fa-sign-out-alt"></i><span>লগআউট</span></button>
      </form>
    </div>

  </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Main -->
<div class="admin-main" id="adminMain">
  <header class="admin-topbar">
    <div style="display:flex;align-items:center;gap:12px">
      <button class="topbar-toggle" id="topbarToggle" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo e(route('admin.dashboard')); ?>">হোম</a>
        <?php if(isset($breadcrumb)): ?>
          <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <?php if($url): ?><a href="<?php echo e($url); ?>"><?php echo e($label); ?></a><?php else: ?><span><?php echo e($label); ?></span><?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </nav>
    </div>
    <div class="topbar-right">
      <div class="topbar-user">
        <i class="fas fa-user-circle"></i>
        <span><?php echo e(auth()->user()->name ?? 'Admin'); ?></span>
      </div>
    </div>
  </header>

  <main class="admin-content">
    <?php if(session('success')): ?>
      <div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?><button class="alert-close">&times;</button></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
      <div class="alert alert-error" role="alert"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?><button class="alert-close">&times;</button></div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
  </main>
</div>

<script src="<?php echo e(asset('js/admin.js')); ?>" defer></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\mmdri\Downloads\goblav\resources\views/layouts/admin.blade.php ENDPATH**/ ?>