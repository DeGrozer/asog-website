        </div><!-- /.content -->
    </div><!-- /.main -->
</div><!-- /.admin-shell -->

<!-- Quill.js Rich-Text Editor -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quill-editor').forEach(function(el) {
        var hiddenInput = el.parentNode.querySelector('.quill-content');
        var quill = new Quill(el, {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'header': [2, 3, 4, false] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
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
