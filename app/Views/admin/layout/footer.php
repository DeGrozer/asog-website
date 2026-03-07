        </div>
    </div>
</div>

<?= jsBaseUrl() ?>
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    /** Upload a File/Blob to the server and return the URL. **/
    function uploadImage(file) {
        var fd = new FormData();
        fd.append('image', file);
        return fetch(window.APP_BASE_URL + '/admin/posts/upload-image', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: fd
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.error) { alert(data.error); return null; }
            return data.url;
        })
        .catch(function() { alert('Image upload failed.'); return null; });
    }

    /** Insert an uploaded image URL into the editor. **/
    function insertImage(quill, url) {
        var range = quill.getSelection(true);
        quill.insertText(range.index, '\n');
        quill.insertEmbed(range.index + 1, 'image', url);
        quill.insertText(range.index + 2, '\n');
        quill.setSelection(range.index + 3);
    }

    document.querySelectorAll('.quill-editor').forEach(function(el) {
        var hiddenInput = el.parentNode.querySelector('.quill-content');
        var quill = new Quill(el, {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        ['bold', 'italic', 'underline'],
                        [{ 'header': [2, 3, false] }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ],
                    handlers: {
                        image: function() {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.click();
                            var q = this.quill;
                            input.onchange = function() {
                                var file = input.files[0];
                                if (!file) return;
                                uploadImage(file).then(function(url) {
                                    if (url) insertImage(q, url);
                                });
                            };
                        }
                    }
                },
                clipboard: { matchVisual: false }
            }
        });

        /** Handle paste — intercept images from clipboard. **/
        quill.root.addEventListener('paste', function(e) {
            var items = (e.clipboardData || window.clipboardData).items;
            if (!items) return;
            for (var i = 0; i < items.length; i++) {
                if (items[i].type.indexOf('image') !== -1) {
                    e.preventDefault();
                    e.stopPropagation();
                    var file = items[i].getAsFile();
                    if (!file) return;
                    uploadImage(file).then(function(url) {
                        if (url) insertImage(quill, url);
                    });
                    return;
                }
            }
        });

        /** Handle drag & drop — intercept dropped image files. **/
        quill.root.addEventListener('drop', function(e) {
            var files = e.dataTransfer && e.dataTransfer.files;
            if (!files || files.length === 0) return;
            var file = files[0];
            if (file.type.indexOf('image') === -1) return;
            e.preventDefault();
            e.stopPropagation();
            uploadImage(file).then(function(url) {
                if (url) insertImage(quill, url);
            });
        });

        if (hiddenInput && hiddenInput.value) {
            quill.root.innerHTML = hiddenInput.value;
        }
        var form = el.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                if (hiddenInput) {
                    hiddenInput.value = quill.root.innerHTML;
                }
            });
        }
    });
});
</script>
</body>
</html>
