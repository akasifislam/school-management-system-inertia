<?php $__env->startSection('content'); ?>

    
    <?php if($bannerNotice): ?>
        <div class="hero-block">
            
            <div class="hero-img">
                <?php if($bannerNotice->file && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $bannerNotice->file)): ?>
                    <img src="<?php echo e(asset('storage/' . $bannerNotice->file)); ?>" alt="<?php echo e($bannerNotice->title); ?>" loading="eager">
                <?php else: ?>
                    
                    <img src="http://www.govlabcomilla.edu.bd/images/golden_jubilee.png" alt="জাতীয় স্মৃতিসৌধ" loading="lazy"
                        onerror="this.parentElement.style.background='linear-gradient(135deg,#1A6DB5,#0097B2)'">
                <?php endif; ?>
            </div>

            
            <div class="hero-body">
                <h2><?php echo e($bannerNotice->title); ?></h2>
                <?php if($bannerNotice->file): ?>
                    <a href="<?php echo e(asset('storage/' . $bannerNotice->file)); ?>" target="_blank"
                        class="hero-link"><?php echo e($bannerNotice->description ?? 'সুবর্ণজয়ন্তী ছবির গ্যালারী'); ?></a>
                <?php endif; ?>
                <div class="hero-footer">
                    <a href="<?php echo e(route('notices')); ?>" class="btn-all">সকল</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="sec-block">
        <div class="sec-inner">

            
            <div class="sec-icon-col">
                <div class="icon-notepad-fa">
                    <span style="font-size:26px;line-height:1">📋</span>
                </div>
            </div>

            
            <div class="sec-body">
                <div class="sec-title">নোটিশ বোর্ড</div>
                <?php if($notices->count()): ?>
                    <ul class="notice-list">
                        <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <?php if($notice->file): ?>
                                    <a href="<?php echo e(asset('storage/' . $notice->file)); ?>" target="_blank"
                                        rel="noopener"><?php echo e($notice->title); ?></a>
                                <?php else: ?>
                                    <span><?php echo e($notice->title); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p style="color:#888;font-size:12.5px;padding:4px 0">কোনো নোটিশ নেই।</p>
                <?php endif; ?>
            </div>

        </div>
        <div class="sec-footer">
            <a href="<?php echo e(route('notices')); ?>" class="btn-all">সকল</a>
        </div>
    </div>

    
    <div class="ticker-row">
        <span class="ticker-lbl">খবর :</span>
        <span class="ticker-sep">›</span>
        <div class="ticker-content">
            <?php if($newsItems->count()): ?>
                <span class="ticker-scroll" aria-live="polite">
                    <?php $__currentLoopData = $newsItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ni): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($ni->link): ?>
                            <a href="<?php echo e($ni->link); ?>" target="_blank"
                                rel="noopener">&nbsp;&nbsp;<?php echo e($ni->title); ?></a>
                        <?php else: ?>
                            &nbsp;&nbsp;<?php echo e($ni->title); ?>

                        <?php endif; ?>
                        &nbsp;&nbsp;|
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
            <?php else: ?>
                <span style="color:#888;font-size:12.5px">কোনো খবর নেই।</span>
            <?php endif; ?>
        </div>
        <div class="ticker-btns">
            <a href="<?php echo e(route('notices')); ?>" class="btn-next">সকল</a>
        </div>
    </div>

    
    <div class="sec-block">
        <div class="sec-inner">

            
            <div class="sec-icon-col">
                <div class="icon-dl-circle">
                    <i class="fas fa-download"></i>
                </div>
            </div>

            
            <div class="sec-body">
                <div class="sec-title">ডাউনলোডস</div>
                <?php if($downloads->count()): ?>
                    <ul class="dl-list">
                        <?php $__currentLoopData = $downloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(asset('storage/' . $dl->file)); ?>" target="_blank"
                                    rel="noopener"><?php echo e($dl->title); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p style="color:#888;font-size:12.5px;padding:4px 0">কোনো ডাউনলোড নেই।</p>
                <?php endif; ?>
            </div>

        </div>
        <div class="sec-footer">
            <a href="<?php echo e(route('downloads')); ?>" class="btn-all">সকল</a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\school website\goblav\resources\views/frontend/pages/home.blade.php ENDPATH**/ ?>