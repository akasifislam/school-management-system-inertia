/* ── Admin JS ── */
(function(){
'use strict';
var sidebar  = document.getElementById('adminSidebar');
var overlay  = document.getElementById('sidebarOverlay');
var tbToggle = document.getElementById('topbarToggle');
var sbClose  = document.getElementById('sidebarClose');

function openSidebar(){
  if(sidebar)  sidebar.classList.add('open');
  if(overlay)  overlay.classList.add('show');
  document.body.style.overflow = 'hidden';
}
function closeSidebar(){
  if(sidebar)  sidebar.classList.remove('open');
  if(overlay)  overlay.classList.remove('show');
  document.body.style.overflow = '';
}

if(tbToggle) tbToggle.addEventListener('click', openSidebar);
if(sbClose)  sbClose.addEventListener('click',  closeSidebar);
if(overlay)  overlay.addEventListener('click',  closeSidebar);

// Auto-dismiss alerts
setTimeout(function(){
  document.querySelectorAll('.alert').forEach(function(el){
    el.style.transition = 'opacity .3s';
    el.style.opacity = '0';
    setTimeout(function(){ el.remove(); }, 300);
  });
}, 4000);

// Alert close btn
document.querySelectorAll('.alert-close').forEach(function(btn){
  btn.addEventListener('click', function(){ this.closest('.alert').remove(); });
});

// Confirm delete
document.querySelectorAll('[data-confirm]').forEach(function(btn){
  btn.addEventListener('click', function(e){
    if(!confirm(this.getAttribute('data-confirm') || 'আপনি কি নিশ্চিত?')) e.preventDefault();
  });
});

// File preview
document.querySelectorAll('input[type="file"][data-preview]').forEach(function(inp){
  inp.addEventListener('change', function(){
    var el = document.getElementById(this.getAttribute('data-preview'));
    if(el && this.files[0]){
      var r = new FileReader();
      r.onload = function(e){ el.src=e.target.result; el.style.display='block'; };
      r.readAsDataURL(inp.files[0]);
    }
  });
});

// Config tabs
window.showTab = function(id, el){
  document.querySelectorAll('.config-section').forEach(function(s){ s.style.display='none'; });
  document.querySelectorAll('.config-tab').forEach(function(t){ t.classList.remove('active-tab'); });
  var sec = document.getElementById(id);
  if(sec) sec.style.display = 'block';
  if(el)  el.classList.add('active-tab');
  if(event) event.preventDefault();
  try{ history.replaceState(null,null,'#'+id); }catch(e){}
};
var hash = window.location.hash;
if(hash){
  var tab = document.querySelector('[href="'+hash+'"]');
  if(tab) showTab(hash.replace('#',''), tab);
}

// Transfer modal
window.openTransfer = function(id, name, cls, shift, section){
  document.getElementById('transferStudentName').textContent = 'শিক্ষার্থী: '+name;
  document.getElementById('transferForm').action = '/admin/student-records/'+id+'/transfer';
  document.getElementById('tf_class').value   = cls;
  document.getElementById('tf_shift').value   = shift;
  document.getElementById('tf_section').value = section || '';
  document.getElementById('transferModal').style.display = 'flex';
};
window.closeTransfer = function(){
  document.getElementById('transferModal').style.display = 'none';
};
var tm = document.getElementById('transferModal');
if(tm) tm.addEventListener('click', function(e){ if(e.target===this) closeTransfer(); });

})();
