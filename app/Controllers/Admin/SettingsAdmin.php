<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\SettingModel;

/**
 * SettingsAdmin — manage site-wide key-value settings.
 */
class SettingsAdmin extends Controller
{
    protected SettingModel $settingModel;

    public function __construct()
    {
        helper(['form', 'url', 'toast']);
        $this->settingModel = new SettingModel();
    }

    // ── SETTINGS FORM ─────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'  => 'Site Settings',
            'activePage' => 'settings',
            'about'      => $this->settingModel->getByGroup('about'),
            'hero'       => $this->settingModel->getByGroup('hero'),
            'cta'        => $this->settingModel->getByGroup('cta'),
            'contact'    => $this->settingModel->getByGroup('contact'),
        ];

        return view('admin/layout/header', $data)
             . view('admin/settings/index', $data)
             . view('admin/layout/footer');
    }

    // ── SAVE SETTINGS ─────────────────────────────
    public function update()
    {
        $fields = $this->request->getPost();

        // Remove CSRF token from fields
        unset($fields['csrf_test_name'], $fields[csrf_token()]);

        foreach ($fields as $key => $value) {
            // Determine group from key prefix
            $group = 'general';
            if (str_starts_with($key, 'about'))   $group = 'about';
            if (str_starts_with($key, 'hero'))     $group = 'hero';
            if (str_starts_with($key, 'cta'))      $group = 'cta';
            if (str_starts_with($key, 'contact'))  $group = 'contact';
            if (str_starts_with($key, 'facebook') || str_starts_with($key, 'instagram')) $group = 'contact';

            $this->settingModel->setSetting($key, $value, $group);
        }

        setToast('success', 'Settings saved.');
        return redirect()->to(site_url('admin/settings'));
    }
}
