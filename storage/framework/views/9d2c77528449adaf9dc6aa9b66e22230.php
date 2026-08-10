<!DOCTYPE html>
<html lang="bn" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <meta name="theme-color" content="#1A6DB5">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? ($settings['school_name_bn'] ?? 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল')); ?> - কুমিল্লা</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        media="all">
    <link rel="stylesheet" href="<?php echo e(asset('css/frontend.css')); ?>">

    
    <style>
        :root {
            --c-primary: <?php echo e($settings['color_primary'] ?? '#1A6DB5'); ?>;
            --c-primary-d: <?php echo e($settings['color_primary_d'] ?? '#0D5A9E'); ?>;
            --c-primary-l: <?php echo e($settings['color_primary_l'] ?? '#2980C9'); ?>;
            --c-accent: <?php echo e($settings['color_accent'] ?? '#E53935'); ?>;
            --c-cyan: <?php echo e($settings['color_cyan'] ?? '#0097B2'); ?>;
            --c-cyan-d: color-mix(in srgb, <?php echo e($settings['color_cyan'] ?? '#0097B2'); ?> 80%, black);
            --c-green: <?php echo e($settings['color_green'] ?? '#2E7D32'); ?>;
        }
    </style>

    <?php if(!empty($settings['custom_css'])): ?>
        <style>
            <?php echo e($settings['custom_css']); ?>

        </style>
    <?php endif; ?>

    <?php if(!empty($settings['google_analytics'])): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($settings['google_analytics']); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?php echo e($settings['google_analytics']); ?>');
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    
    <?php if(!empty($announcements) && $announcements->isNotEmpty()): ?>
        <?php $__currentLoopData = $announcements->where('show_banner', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ann): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $bc = [
                    'info' => ['#dbeafe', '#1d4ed8', '#1e40af'],
                    'success' => ['#dcfce7', '#15803d', '#14532d'],
                    'warning' => ['#fef3c7', '#d97706', '#92400e'],
                    'danger' => ['#fee2e2', '#dc2626', '#991b1b'],
                ];
                $c = $bc[$ann->type] ?? $bc['info'];
            ?>
            <div
                style="background:<?php echo e($c[0]); ?>;border-bottom:2px solid <?php echo e($c[1]); ?>;padding:8px 18px;display:flex;align-items:center;gap:10px;font-size:13px;color:<?php echo e($c[2]); ?>;position:relative;z-index:10">
                <i class="fas fa-bullhorn" style="color:<?php echo e($c[1]); ?>;flex-shrink:0"></i>
                <strong><?php echo e($ann->title); ?>:</strong>
                <span><?php echo e($ann->message); ?></span>
                <button onclick="this.parentElement.remove()"
                    style="margin-left:auto;background:transparent;border:none;font-size:20px;cursor:pointer;color:<?php echo e($c[2]); ?>;opacity:.7;line-height:1"
                    aria-label="Close">×</button>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <?php if(!empty($announcements) && $announcements->where('show_popup', true)->isNotEmpty()): ?>
        <?php
            $popup = $announcements->where('show_popup', true)->first();
            $bc2 = [
                'info' => ['#1A6DB5', '#dbeafe', '#1e40af'],
                'success' => ['#15803d', '#dcfce7', '#14532d'],
                'warning' => ['#d97706', '#fef3c7', '#92400e'],
                'danger' => ['#dc2626', '#fee2e2', '#991b1b'],
            ];
            $pc = $bc2[$popup->type] ?? $bc2['info'];
        ?>
        <div id="annPopup"
            style="position:fixed;inset:0;background:rgba(0,0,0,.58);z-index:9999;display:flex;align-items:center;justify-content:center;padding:16px">
            <div
                style="background:#fff;border-radius:10px;max-width:460px;width:100%;box-shadow:0 25px 70px rgba(0,0,0,.35);overflow:hidden;animation:popIn .25s ease">
                <div
                    style="background:<?php echo e($pc[0]); ?>;padding:15px 20px;display:flex;justify-content:space-between;align-items:center">
                    <h3 style="color:#fff;font-size:15px;margin:0;font-family:var(--font)"><?php echo e($popup->title); ?></h3>
                    <button onclick="document.getElementById('annPopup').remove()"
                        style="background:transparent;border:none;color:rgba(255,255,255,.8);font-size:24px;cursor:pointer;line-height:1"
                        aria-label="Close">×</button>
                </div>
                <div style="padding:18px 20px;font-size:13.5px;color:#263238;line-height:1.7;font-family:var(--font)">
                    <?php echo e($popup->message); ?></div>
                <div style="padding:11px 20px;background:#f8f9fa;text-align:right;border-top:1px solid #eee">
                    <button onclick="document.getElementById('annPopup').remove()"
                        style="background:<?php echo e($pc[0]); ?>;color:#fff;border:none;padding:8px 24px;border-radius:4px;font-size:13px;cursor:pointer;font-family:var(--font);font-weight:600">ঠিক
                        আছে</button>
                </div>
            </div>
        </div>
        <style>
            @keyframes popIn {
                from {
                    opacity: 0;
                    transform: scale(.92)
                }

                to {
                    opacity: 1;
                    transform: scale(1)
                }
            }
        </style>
    <?php endif; ?>

    
    <div class="page-wrap" id="top">

        
        <header class="site-header" role="banner">
            <?php if(!empty($settings['banner'])): ?>
                
                <img src="<?php echo e(asset('storage/' . $settings['banner'])); ?>" class="hdr-banner"
                    alt="<?php echo e($settings['school_name_bn'] ?? 'School Banner'); ?>" loading="eager" fetchpriority="high">
                <div class="hdr-overlay">
                    <?php if(!empty($settings['logo'])): ?>
                        <img src="<?php echo e(asset('storage/' . $settings['logo'])); ?>" class="hdr-logo" alt="School Logo">
                    <?php else: ?>
                        <div class="hdr-logo-ph"><i class="fas fa-school"></i></div>
                    <?php endif; ?>
                    <div class="hdr-text">
                        <h1><?php echo e($settings['school_name_bn'] ?? 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল'); ?></h1>
                        <p>সদর দক্ষিণ, কুমিল্লা</p>
                    </div>
                </div>
            <?php else: ?>
                
                <div class="hdr-no-banner">
                    <?php if(!empty($settings['logo'])): ?>
                        <img src="<?php echo e(asset('storage/' . $settings['logo'])); ?>" class="hdr-logo" alt="School Logo">
                    <?php else: ?>
                        <div class="hdr-logo-ph"><i class="fas fa-school"></i></div>
                    <?php endif; ?>
                    <div class="hdr-text">
                        <h1><?php echo e($settings['school_name_bn'] ?? 'গভর্নমেন্ট ল্যাবরেটরি হাই স্কুল'); ?></h1>
                        <p>সদর দক্ষিণ, কুমিল্লা</p>
                    </div>
                </div>
            <?php endif; ?>
        </header>

        
        <nav class="main-nav" role="navigation" aria-label="প্রধান নেভিগেশন">
            <div class="nav-inner">
                <button class="nav-toggle" id="navToggle" aria-label="নেভিগেশন মেনু" aria-expanded="false">
                    <i class="fas fa-bars" id="navIcon"></i>
                </button>
                <ul class="nav-list" id="navList" role="menubar">

                    <li class="nav-li <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('home')); ?>" class="nav-link" role="menuitem">প্রথম পাতা</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('about*') ? 'active' : ''); ?>" role="none">
                        <span class="nav-link" role="menuitem" tabindex="0" aria-haspopup="true">
                            পরিচিতি <i class="fas fa-chevron-down chev"></i>
                        </span>
                        <ul class="nav-drop" role="menu">
                            <li><a href="<?php echo e(route('about.overview')); ?>" role="menuitem">এক নজরে বিদ্যালয়</a></li>
                            <li><a href="<?php echo e(route('about.history')); ?>" role="menuitem">সংক্ষিপ্ত ইতিহাস</a></li>
                        </ul>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('information') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('information')); ?>" class="nav-link" role="menuitem">জনবল</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('students*') ? 'active' : ''); ?>" role="none">
                        <span class="nav-link" role="menuitem" tabindex="0" aria-haspopup="true">
                            শিক্ষার্থী <i class="fas fa-chevron-down chev"></i>
                        </span>
                        <ul class="nav-drop" role="menu">
                            <li><a href="<?php echo e(route('students.count')); ?>" role="menuitem">অধ্যয়নরত শিক্ষার্থীর
                                    সংখ্যা</a></li>
                            <li><a href="<?php echo e(route('students.list')); ?>" role="menuitem">অধ্যয়নরত শিক্ষার্থীর
                                    তালিকা</a></li>
                        </ul>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('results*') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('results')); ?>" class="nav-link" role="menuitem">পরীক্ষার ফলাফল</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('gallery') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('gallery')); ?>" class="nav-link" role="menuitem">ছবির গ্যালারী</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('contact')); ?>" class="nav-link" role="menuitem">যোগাযোগ</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('apa') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('apa')); ?>" class="nav-link" role="menuitem">এপিএ</a>
                    </li>

                    <li class="nav-li <?php echo e(request()->routeIs('sudhachar') ? 'active' : ''); ?>" role="none">
                        <a href="<?php echo e(route('sudhachar')); ?>" class="nav-link" role="menuitem">সুধাচার কৌশল</a>
                    </li>

                </ul>
            </div>
        </nav>

        
        <div class="body-wrap">
            <div class="content-grid">

                
                <main class="primary" role="main" id="main-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>

                
                <aside class="sidebar" role="complementary" aria-label="সাইডবার">

                    
                    <div class="sw">
                        <div class="sw-hdr gray">প্রধান শিক্ষক</div>
                        <div class="principal-card">
                            <?php if(!empty($principal->photo)): ?>
                                <img src="<?php echo e(asset('storage/' . $principal->photo)); ?>" class="principal-photo"
                                    alt="<?php echo e($principal->name ?? 'প্রধান শিক্ষক'); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="principal-ph"><i class="fas fa-user"></i></div>
                            <?php endif; ?>
                            <p class="principal-name"><?php echo e($principal->name ?? 'রোকসানা ফেরদৌস মজুমদার'); ?></p>
                        </div>
                    </div>

                    
                    <div class="sw">
                        <div class="sw-hdr blue">অভ্যন্তরীণ ই-সেবা</div>
                        <ul class="sw-links">
                            <li><a href="https://eshikshabd.com/" target="_blank"
                                    rel="noopener noreferrer">ই-স্কুল</a></li>
                            <li><a href="https://www.pathshala.gov.bd/" target="_blank"
                                    rel="noopener noreferrer">পাঠশালা</a></li>
                            <li><a href="https://pdms.gov.bd/" target="_blank" rel="noopener noreferrer">পিডিএস
                                    (সরকারি মাধ্যমিক)</a></li>
                            <li><a href="<?php echo e(route('admission.apply')); ?>" class="red-link">ভর্তি পরীক্ষার আবেদন</a>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="sw">
                        <div class="sw-hdr blue">গুরুত্বপূর্ণ লিংক</div>
                        <ul class="sw-links">
                            <li><a href="https://www.moedu.gov.bd/" target="_blank" rel="noopener noreferrer">শিক্ষা
                                    মন্ত্রণালয়</a></li>
                            <li><a href="https://www.dshe.gov.bd/" target="_blank" rel="noopener noreferrer">মাধ্যমিক
                                    ও উচ্চ শিক্ষা অধিদপ্তর</a></li>
                            <li><a href="https://www.banebeis.gov.bd/" target="_blank"
                                    rel="noopener noreferrer">ব্যানবেইজ</a></li>
                            <li><a href="#" target="_blank">নায়েম</a></li>
                            <li><a href="https://www.nctb.gov.bd/" target="_blank"
                                    rel="noopener noreferrer">এনসিটিবি</a></li>
                            <li><a href="#" target="_blank">শিক্ষক বাতায়ন</a></li>
                            <li><a href="#" target="_blank">কিশোর বাতায়ন</a></li>
                        </ul>
                    </div>

                    
                    <div class="sw">
                        <div class="sw-hdr green">ওয়েব মাস্টার</div>
                        <ul class="sw-links">
                            <li><a href="<?php echo e(route('admin.login')); ?>">ওয়েব মাস্টার লগইন</a></li>
                        </ul>
                    </div>

                </aside>
            </div>
        </div>

        
        <footer class="site-footer" role="contentinfo">
            <div class="footer-inner">
                <div>
                    <p><strong>কারিগরি সহায়তায়:</strong></p>
                    <p>Develop ByGovtproject</p>
                    <p>Email: <a href="mailto:dev_govlab_school@gmail.com"
                            class="footer-link">dev_govlab_school@gmail.com</a></p>
                </div>
                <div class="footer-r">
                    <p><strong>পরিকল্পনা ও বাস্তবায়নে:</strong></p>
                    <p>বিদ্যালয় ও পরিদর্শন শাখা</p>
                    <p>মাধ্যমিক ও উচ্চ শিক্ষা অধিদপ্তর</p>
                </div>
            </div>
        </footer>

    </div>

    <?php if(!empty($settings['custom_js'])): ?>
        <script>
            <?php echo e($settings['custom_js']); ?>

        </script>
    <?php endif; ?>

    <script src="<?php echo e(asset('js/frontend.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH E:\school website\goblav\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>