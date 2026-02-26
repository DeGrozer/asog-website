<?php

/**
 * Toast Helper — reusable flash-message helpers for the admin panel.
 *
 * Usage in controllers:
 *   helper('toast');
 *   setToast('success', 'Post created successfully.');
 *   setToast('error',   'Something went wrong.');
 *   setToast('info',    'No changes were made.');
 *
 * Usage in views:
 *   <?= renderToast() ?>
*/

if (! function_exists('setToast')) {
/**
* Set a flash toast message.
*
* @param string $type One of: success, error, info, warning
* @param string $message The toast body text.
*/
function setToast(string $type, string $message): void
{
session()->setFlashdata('toast_type', $type);
session()->setFlashdata('toast_message', $message);
}
}

if (! function_exists('renderToast')) {
/**
* Render the toast HTML if a flash message exists.
* Returns empty string if no toast is queued.
*/
function renderToast(): string
{
$type = session()->getFlashdata('toast_type');
$message = session()->getFlashdata('toast_message');

if (empty($type) || empty($message)) {
return '';
}

$bg = [
'success' => '#f0fdf4',
'error' => '#fef2f2',
'warning' => '#fffbeb',
'info' => '#f0f7ff',
];

$fg = [
'success' => '#166534',
'error' => '#991b1b',
'warning' => '#92400e',
'info' => '#1e40af',
];

$border = [
'success' => '#bbf7d0',
'error' => '#fecaca',
'warning' => '#fde68a',
'info' => '#bfdbfe',
];

$b  = $bg[$type]     ?? $bg['info'];
$f  = $fg[$type]     ?? $fg['info'];
$bd = $border[$type] ?? $border['info'];

return <<<HTML
<div id="toast" style="position:fixed;bottom:1.25rem;left:1.25rem;z-index:9999;background:{$b};border:1px solid {$bd};padding:.55rem .9rem;border-radius:.3rem;font-size:.78rem;font-family:'DM Sans',sans-serif;color:{$f};max-width:340px;opacity:0;transform:translateY(6px);transition:opacity .25s,transform .25s">
    {$message}
</div>
<script>
(function(){
    var t=document.getElementById('toast');
    if(!t)return;
    requestAnimationFrame(function(){t.style.opacity='1';t.style.transform='translateY(0)'});
    setTimeout(function(){t.style.opacity='0';t.style.transform='translateY(6px)';setTimeout(function(){t.remove()},250)},3500);
})();
</script>
HTML;
    }
    }