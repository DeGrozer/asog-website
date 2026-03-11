(function() {
    /* ── Logo Upload Zone ── */
    var zone = document.getElementById('uploadZone');
    var input = document.getElementById('logoInput');
    var preview = document.getElementById('uploadPreview');
    var label = document.getElementById('uploadLabel');

    if (preview.querySelector('img')) label.style.display = 'none';

    zone.addEventListener('click', function(e) {
        if (e.target === input) return;
        input.click();
    });

    input.addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="">';
            label.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    zone.addEventListener('dragover', function(e) {
        e.preventDefault();
        zone.style.borderColor = '#03558C';
        zone.style.background = '#fafcff';
    });
    zone.addEventListener('dragleave', function() {
        zone.style.borderColor = '';
        zone.style.background = '';
    });
    zone.addEventListener('drop', function(e) {
        e.preventDefault();
        zone.style.borderColor = '';
        zone.style.background = '';
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            input.files = files;
            input.dispatchEvent(new Event('change'));
        }
    });

    /* ── White Logo Upload Zone ── */
    var zoneW = document.getElementById('uploadZoneWhite');
    var inputW = document.getElementById('logoWhiteInput');
    var previewW = document.getElementById('uploadPreviewWhite');
    var labelW = document.getElementById('uploadLabelWhite');

    if (previewW.querySelector('img')) labelW.style.display = 'none';

    zoneW.addEventListener('click', function(e) {
        if (e.target === inputW) return;
        inputW.click();
    });

    inputW.addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            previewW.innerHTML = '<img src="' + e.target.result + '" alt="" style="background:#03355a;padding:.5rem;border-radius:.3rem">';
            labelW.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    zoneW.addEventListener('dragover', function(e) {
        e.preventDefault();
        zoneW.style.borderColor = '#03558C';
        zoneW.style.background = '#fafcff';
    });
    zoneW.addEventListener('dragleave', function() {
        zoneW.style.borderColor = '';
        zoneW.style.background = '';
    });
    zoneW.addEventListener('drop', function(e) {
        e.preventDefault();
        zoneW.style.borderColor = '';
        zoneW.style.background = '';
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            inputW.files = files;
            inputW.dispatchEvent(new Event('change'));
        }
    });

    /* ── Team Members Repeater ── */
    var tmRows = document.getElementById('tmRows');
    var tmAdd = document.getElementById('tmAdd');

    tmAdd.addEventListener('click', function() {
        var row = document.createElement('div');
        row.className = 'tm-row';
        row.innerHTML = '<input type="text" name="tm_name[]" placeholder="Name">' +
            '<input type="text" name="tm_role[]" placeholder="Role (e.g. CEO, CTO)">' +
            '<button type="button" class="tm-remove" title="Remove">×</button>';
        tmRows.appendChild(row);
        row.querySelector('input').focus();
    });

    tmRows.addEventListener('click', function(e) {
        if (e.target.classList.contains('tm-remove')) {
            var row = e.target.closest('.tm-row');
            if (tmRows.querySelectorAll('.tm-row').length > 1) {
                row.remove();
            } else {
                row.querySelectorAll('input').forEach(function(inp) {
                    inp.value = '';
                });
            }
        }
    });
})();
