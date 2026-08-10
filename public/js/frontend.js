/* ── Premium Frontend JS ── */
(function () {
  'use strict';

  /* ── Mobile Navigation ── */
  var toggle  = document.getElementById('navToggle');
  var navList = document.getElementById('navList');
  var navIcon = document.getElementById('navIcon');

  if (toggle && navList) {
    toggle.addEventListener('click', function () {
      var isOpen = navList.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen);
      if (navIcon) {
        navIcon.className = isOpen ? 'fas fa-times' : 'fas fa-bars';
      }
    });
  }

  /* ── Mobile Dropdown Toggle ── */
  document.querySelectorAll('.nav-li > span.nav-link').forEach(function (span) {
    span.addEventListener('click', function () {
      if (window.innerWidth > 680) return;
      var li = this.parentElement;
      var wasOpen = li.classList.contains('open');
      // Close all others
      document.querySelectorAll('.nav-li.open').forEach(function (el) {
        el.classList.remove('open');
      });
      if (!wasOpen) li.classList.add('open');
    });
    /* Keyboard support */
    span.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.click();
      }
    });
  });

  /* ── Close nav on outside click ── */
  document.addEventListener('click', function (e) {
    if (!navList) return;
    if (toggle && !toggle.contains(e.target) && !navList.contains(e.target)) {
      navList.classList.remove('open');
      if (toggle) toggle.setAttribute('aria-expanded', 'false');
      if (navIcon) navIcon.className = 'fas fa-bars';
    }
  });

  /* ── Close nav on Escape ── */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && navList && navList.classList.contains('open')) {
      navList.classList.remove('open');
      if (toggle) { toggle.setAttribute('aria-expanded', 'false'); toggle.focus(); }
      if (navIcon) navIcon.className = 'fas fa-bars';
    }
  });

  /* ── Gallery Lightbox ── */
  window.openLightbox = function (src, cap) {
    var lb = document.getElementById('lightbox');
    if (!lb) return;
    document.getElementById('lbImg').src = src;
    var lbCap = document.getElementById('lbCap');
    if (lbCap) lbCap.textContent = cap || '';
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  };

  window.closeLightbox = function () {
    var lb = document.getElementById('lightbox');
    if (lb) { lb.style.display = 'none'; document.body.style.overflow = ''; }
  };

  var lb = document.getElementById('lightbox');
  if (lb) {
    lb.addEventListener('click', function (e) { if (e.target === this) closeLightbox(); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeLightbox();
    });
  }

  /* ── Photo Preview ── */
  window.previewPhoto = function (inp, imgId, phId) {
    var img = document.getElementById(imgId);
    var ph  = document.getElementById(phId);
    if (inp.files && inp.files[0] && img) {
      var r = new FileReader();
      r.onload = function (e) {
        img.src = e.target.result;
        img.style.display = 'block';
        if (ph) ph.style.display = 'none';
      };
      r.readAsDataURL(inp.files[0]);
    }
  };

  /* ── Smooth scroll to top ── */
  window.scrollToTop = function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  /* ── Add scroll-to-top button after scroll ── */
  var scrollBtn = null;
  window.addEventListener('scroll', function () {
    if (window.scrollY > 400) {
      if (!scrollBtn) {
        scrollBtn = document.createElement('button');
        scrollBtn.innerHTML = '▲';
        scrollBtn.setAttribute('aria-label', 'উপরে যান');
        scrollBtn.style.cssText = 'position:fixed;bottom:20px;right:22px;width:38px;height:38px;border-radius:50%;background:var(--c-primary);color:#fff;border:none;font-size:16px;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.25);z-index:888;transition:all .2s;opacity:.85;display:flex;align-items:center;justify-content:center';
        scrollBtn.onclick = function () { window.scrollTo({ top: 0, behavior: 'smooth' }); };
        scrollBtn.onmouseenter = function () { this.style.opacity = '1'; this.style.transform = 'scale(1.1)'; };
        scrollBtn.onmouseleave = function () { this.style.opacity = '.85'; this.style.transform = 'scale(1)'; };
        document.body.appendChild(scrollBtn);
      }
    } else if (scrollBtn) {
      scrollBtn.remove();
      scrollBtn = null;
    }
  });

})();
