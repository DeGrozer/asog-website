<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    /**
     * Display the login form.
     */
    public function login()
    {
        // If already logged in, redirect to admin dashboard
        if (session()->has('admin_id')) {
            return redirect()->to('/admin');
        }

        return view('admin/auth/login');
    }

    /**
     * Authenticate the admin user against the database.
     */
    public function authenticate()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin      = $adminModel->attempt($email, $password);

        if ($admin !== null) {
            // Set session from the DB row
            session()->set([
                'admin_id'    => $admin['id'],
                'admin_name'  => $admin['fullName'],
                'admin_email' => $admin['email'],
                'admin_role'  => $admin['role'],
                'logged_in'   => true,
            ]);

            return redirect()->to('/admin');
        }

        // Login failed
        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    /**
     * Logout the admin user.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/asog-admin')->with('success', 'Logged out successfully.');
    }
}
