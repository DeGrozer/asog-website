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
     * @param string $type    One of: success, error, info, warning
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
        $type    = session()->getFlashdata('toast_type');
        $message = session()->getFlashdata('toast_message');

        if (empty($type) || empty($message)) {
            return '';
        }

        $colors = [
            'success' => ['bg' => '#ecfdf5', 'border' => '#10b981', 'text' => '#065f46', 'icon' => '✓'],
            'error'   => ['bg' => '#fef2f2', 'border' => '#ef4444', 'text' => '#991b1b', 'icon' => '✕'],
            'warning' => ['bg' => '#fffbeb', 'border' => '#f59e0b', 'text' => '#92400e', 'icon' => '!'],
            'info'    => ['bg' => '#eff6ff', 'border' => '#3b82f6', 'text' => '#1e40af', 'icon' => 'ℹ'],
        ];

        $c = $colors[$type] ?? $colors['info'];

        return <<<HTML
        <div id="toast"
             style="position:fixed;top:1.5rem;right:1.5rem;z-index:9999;display:flex;align-items:center;gap:.75rem;
                    background:{$c['bg']};border:1px solid {$c['border']}30;border-left:4px solid {$c['border']};
                    color:{$c['text']};padding:.875rem 1.25rem;border-radius:.5rem;
                    box-shadow:0 4px 24px rgba(0,0,0,.08);font-size:.875rem;font-family:'DM Sans',sans-serif;
                    max-width:420px;animation:toastIn .35s ease forwards;">
            <span style="font-size:1.15rem;font-weight:700;line-height:1">{$c['icon']}</span>
            <span style="flex:1">{$message}</span>
            <button onclick="this.parentElement.remove()"
                    style="background:none;border:none;cursor:pointer;font-size:1.1rem;color:{$c['text']}80;padding:0 0 0 .5rem;line-height:1">×</button>
        </div>
        <style>
            @keyframes toastIn{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:translateX(0)}}
        </style>
        <script>setTimeout(()=>{const t=document.getElementById('toast');if(t){t.style.transition='opacity .4s,transform .4s';t.style.opacity='0';t.style.transform='translateX(40px)';setTimeout(()=>t.remove(),400)}},4000)</script>
        HTML;
    }
}
