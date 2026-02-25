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

        $accents = [
            'success' => '#10b981',
            'error'   => '#ef4444',
            'warning' => '#f59e0b',
            'info'    => '#03558C',
        ];

        $icons = [
            'success' => '✓',
            'error'   => '✕',
            'warning' => '!',
            'info'    => 'ℹ',
        ];

        $accent = $accents[$type] ?? $accents['info'];
        $icon   = $icons[$type] ?? $icons['info'];

        return <<<HTML
        <div id="toast" style="position:fixed;top:1.25rem;right:1.25rem;z-index:9999;display:flex;align-items:flex-start;gap:.6rem;background:#fff;border:1px solid #e5e7eb;border-left:3px solid {$accent};padding:.8rem 1rem;border-radius:.2rem;box-shadow:0 4px 20px rgba(0,0,0,.07);font-size:.82rem;font-family:'DM Sans',sans-serif;color:#334155;max-width:380px;min-width:240px;animation:toastIn .3s ease forwards">
            <span style="color:{$accent};font-weight:700;font-size:.9rem;line-height:1;margin-top:.1rem">{$icon}</span>
            <span style="flex:1;line-height:1.5">{$message}</span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;font-size:.9rem;color:#94a3b8;padding:0;line-height:1;margin-left:.25rem">×</button>
        </div>
        <style>@keyframes toastIn{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}</style>
        <script>setTimeout(()=>{const t=document.getElementById('toast');if(t){t.style.transition='opacity .3s,transform .3s';t.style.opacity='0';t.style.transform='translateY(-8px)';setTimeout(()=>t.remove(),300)}},4000)</script>
        HTML;
    }
}
