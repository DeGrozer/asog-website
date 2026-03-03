/* ═══════════════════════════════════════════════════════════════════
   ASOG-TBI — Incubatee Application Form
   · Form persistence via sessionStorage (survives refresh)
   · Real-time inline validation
   · Async duplicate-email check
   · Preview modal before submission
   ═══════════════════════════════════════════════════════════════════ */
(function () {

  /* ─────────────────────────────────────────────────────────────────
     1. SESSION STORAGE PERSISTENCE
        Saves text field values as the user types.
        Restores them on page load ONLY when the field is still empty
        (so CI4 old() values from validation-fail redirects take priority).
  ───────────────────────────────────────────────────────────────────── */
  var STORAGE_KEY = 'asog_apply_form_v1';
  var persistIds  = [
    'applicantName', 'applicantEmail', 'contactNumber',
    'startupName', 'startupDescription',
    'mainRisk', 'shortTermGoals',
    'videoPresentationLink'
  ];

  // Restore saved values (skip if field already has a server-rendered value)
  try {
    var saved = JSON.parse(sessionStorage.getItem(STORAGE_KEY) || 'null');
    if (saved) {
      persistIds.forEach(function (id) {
        var el = document.getElementById(id);
        if (el && !el.value && saved[id]) {
          el.value = saved[id];
        }
      });
    }
  } catch (e) {}

  // Auto-save on every input event
  function saveToStorage() {
    try {
      var data = {};
      persistIds.forEach(function (id) {
        var el = document.getElementById(id);
        if (el) data[id] = el.value;
      });
      sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    } catch (e) {}
  }

  persistIds.forEach(function (id) {
    var el = document.getElementById(id);
    if (el) el.addEventListener('input', saveToStorage);
  });


  /* ─────────────────────────────────────────────────────────────────
     2. REAL-TIME INLINE VALIDATION
  ───────────────────────────────────────────────────────────────────── */
  var rules = {
    'required': function (v) { return v.trim().length > 0 || 'This field is required.'; },
    'min:2':    function (v) { return v.trim().length >= 2  || 'Must be at least 2 characters.'; },
    'min:10':   function (v) { return v.trim().length >= 10 || 'Must be at least 10 characters.'; },
    'email':    function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) || 'Enter a valid email.'; },
    'phone':    function (v) { return /^[0-9\s\-\+\(\)]{7,20}$/.test(v)   || 'Enter a valid phone number.'; },
    'url':      function (v) { return /^https?:\/\/.+\..+/.test(v)         || 'Enter a valid URL (https://...).'; },
    'name':     function (v) { return /^[A-Za-z\u00C0-\u00FF\s,\.]+$/.test(v) || 'Use format: Last Name, First Name MI'; },
  };

  function validate(el) {
    var checks = (el.dataset.v || '').split('|').filter(Boolean);
    var val    = el.value;
    var msg    = el.closest('div') && el.closest('div').querySelector('.v-msg');
    if (!msg) return true;

    if (!val.trim() && !checks.includes('required')) {
      msg.classList.add('hidden'); msg.textContent = '';
      el.classList.remove('!text-red-600');
      return true;
    }

    for (var i = 0; i < checks.length; i++) {
      var fn     = rules[checks[i]];
      if (!fn) continue;
      var result = fn(val);
      if (result !== true) {
        msg.textContent = result;
        msg.classList.remove('hidden');
        el.classList.add('!text-red-600');
        return false;
      }
    }

    msg.classList.add('hidden'); msg.textContent = '';
    el.classList.remove('!text-red-600');
    return true;
  }

  function validateAll() {
    var ok = true;
    document.querySelectorAll('.v-field[data-v]').forEach(function (el) {
      if (!validate(el)) ok = false;
    });

    // Check duplicate-email flag
    var ef = document.getElementById('applicantEmail');
    if (ef && ef.dataset.dupEmail === '1') {
      ok = false;
      var emsg = ef.closest('div') && ef.closest('div').querySelector('.v-msg');
      if (emsg && emsg.classList.contains('hidden')) {
        emsg.textContent = 'This email has already been used in a previous application.';
        emsg.classList.remove('hidden');
        ef.classList.add('!text-red-600');
      }
    }

    // Lean Canvas is required — must have a file selected
    var lcInput = document.getElementById('leanCanvas');
    var lcErr   = document.getElementById('leanCanvasErr');
    if (lcInput && lcErr) {
      if (!lcInput.files || lcInput.files.length === 0) {
        lcErr.textContent = 'Please upload your completed Lean Canvas (.docx or PDF).';
        lcErr.classList.remove('hidden');
        ok = false;
      } else {
        lcErr.classList.add('hidden');
        lcErr.textContent = '';
      }
    }

    if (!ok) {
      var first = document.querySelector('.v-msg:not(.hidden)');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    return ok;
  }

  // Attach blur / input listeners to all validated fields
  document.querySelectorAll('.v-field').forEach(function (el) {
    el.addEventListener('blur', function () { validate(el); });
    el.addEventListener('input', function () {
      var msg = el.closest('div') && el.closest('div').querySelector('.v-msg');
      if (msg && !msg.classList.contains('hidden')) validate(el);
    });
  });

  // Show server-side errors (already in DOM as .v-msg text)
  document.querySelectorAll('.v-msg').forEach(function (msg) {
    if (msg.textContent.trim()) {
      msg.classList.remove('hidden');
      var f = msg.closest('div') && msg.closest('div').querySelector('.v-field');
      if (f) f.classList.add('!text-red-600');
    }
  });


  /* ─────────────────────────────────────────────────────────────────
     3. ASYNC DUPLICATE-EMAIL CHECK
  ───────────────────────────────────────────────────────────────────── */
  var form          = document.querySelector('form');
  var checkEmailUrl = (form && form.dataset.checkUrl) || '';
  var emailTimer    = null;
  var emailField    = document.getElementById('applicantEmail');

  if (emailField && checkEmailUrl) {
    var checkDupe = function () {
      if (!validate(emailField)) return;
      var val = emailField.value.trim();
      if (!val) return;
      var msg = emailField.closest('div') && emailField.closest('div').querySelector('.v-msg');

      fetch(checkEmailUrl + '?email=' + encodeURIComponent(val))
        .then(function (r) { return r.json(); })
        .then(function (d) {
          if (d.exists) {
            if (msg) {
              msg.textContent = 'This email has already been used in a previous application.';
              msg.classList.remove('hidden');
            }
            emailField.classList.add('!text-red-600');
            emailField.dataset.dupEmail = '1';
          } else {
            emailField.dataset.dupEmail = '0';
          }
        })
        .catch(function () {});
    };

    emailField.addEventListener('blur', function () {
      clearTimeout(emailTimer);
      emailTimer = setTimeout(checkDupe, 150);
    });
    emailField.addEventListener('input', function () {
      emailField.dataset.dupEmail = '0';
    });
  }


  /* ─────────────────────────────────────────────────────────────────
     4. PREVIEW MODAL
  ───────────────────────────────────────────────────────────────────── */
  var modal = document.getElementById('previewModal');
  var body  = document.getElementById('previewBody');
  var esc   = function (e) { if (e.key === 'Escape') closeModal(); };

  function openModal() {
    // Populate text fields
    var textFields = [
      'applicantName', 'applicantEmail', 'contactNumber',
      'startupName', 'startupDescription', 'mainRisk', 'shortTermGoals'
    ];
    textFields.forEach(function (id) {
      var el = document.getElementById(id);
      var pv = document.getElementById('pv_' + id);
      if (el && pv) pv.textContent = el.value.trim() || '—';
    });

    // Video link
    var vLink  = document.getElementById('videoPresentationLink');
    var pvLink = document.getElementById('pv_videoPresentationLink');
    if (vLink && pvLink) {
      var url = vLink.value.trim();
      pvLink.textContent = url || '—';
      pvLink.href        = url || '#';
    }

    // CV files
    var cvInput = document.getElementById('teamCv');
    var pvCv    = document.getElementById('pv_teamCv');
    if (cvInput && pvCv) {
      pvCv.textContent = cvInput.files.length > 0
        ? Array.from(cvInput.files).map(function (f) { return f.name; }).join(', ')
        : 'None uploaded';
    }

    // Lean Canvas file
    var lcInput = document.getElementById('leanCanvas');
    var pvLc    = document.getElementById('pv_leanCanvas');
    if (lcInput && pvLc) {
      pvLc.textContent = lcInput.files.length > 0 ? lcInput.files[0].name : 'No file uploaded';
    }

    modal.classList.remove('opacity-0', 'pointer-events-none');
    if (body) { body.classList.remove('scale-95'); body.classList.add('scale-100'); }
    document.body.style.overflow = 'hidden';
    document.addEventListener('keydown', esc);
  }

  function closeModal() {
    modal.classList.add('opacity-0', 'pointer-events-none');
    if (body) { body.classList.remove('scale-100'); body.classList.add('scale-95'); }
    document.body.style.overflow = '';
    document.removeEventListener('keydown', esc);
  }

  // Review & Submit button → validate first, then show modal
  var btnPreview = document.getElementById('btnPreview');
  if (btnPreview) {
    btnPreview.addEventListener('click', function () {
      if (validateAll()) openModal();
    });
  }

  // Close actions
  var btnClose   = document.getElementById('btnClosePreview');
  var btnBack    = document.getElementById('btnBackEdit');
  var backdrop   = document.getElementById('previewBackdrop');
  if (btnClose)  btnClose.addEventListener('click', closeModal);
  if (btnBack)   btnBack.addEventListener('click', closeModal);
  if (backdrop)  backdrop.addEventListener('click', closeModal);

  // Confirm & Submit → clear storage, close modal, submit form
  var btnConfirm = document.getElementById('btnConfirmSubmit');
  if (btnConfirm) {
    btnConfirm.addEventListener('click', function () {
      try { sessionStorage.removeItem(STORAGE_KEY); } catch (e) {}
      closeModal();
      if (form) form.submit();
    });
  }

  // Block native submit (Enter key) → route through preview
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (validateAll()) openModal();
    });
  }

})();
