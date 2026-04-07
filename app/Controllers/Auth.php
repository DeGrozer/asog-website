<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Google\Client as GoogleClient;
use Google\Service\Oauth2;

class Auth extends BaseController
{
    /**
     * Display the login form.
     */
    public function login()
    {
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
        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin      = $adminModel->attempt($email, $password);

        if ($admin !== null) {
            $this->setAdminSession($admin);
            return redirect()->to('/admin');
        }

        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    /**
     * Redirects to Google OAuth consent page.
     */
    public function google()
    {
        if (session()->has('admin_id')) {
            return redirect()->to('/admin');
        }

        $client = $this->buildGoogleClient();
        if ($client === null) {
            return redirect()->to('/asog-admin')->with('error', 'Google login is not configured yet.');
        }

        $state = bin2hex(random_bytes(16));
        session()->set('google_oauth_state', $state);

        $client->setState($state);

        return redirect()->to($client->createAuthUrl());
    }

    /**
     * Handles Google OAuth callback and logs in if account is authorized.
     */
    public function googleCallback()
    {
        $requestState = (string) $this->request->getGet('state');
        $sessionState = (string) session()->get('google_oauth_state');
        session()->remove('google_oauth_state');

        if ($sessionState === '' || $requestState === '' || ! hash_equals($sessionState, $requestState)) {
            return redirect()->to('/asog-admin')->with('error', 'Invalid Google login state. Please try again.');
        }

        $code = (string) $this->request->getGet('code');
        if ($code === '') {
            return redirect()->to('/asog-admin')->with('error', 'Google login was cancelled or failed.');
        }

        $client = $this->buildGoogleClient();
        if ($client === null) {
            return redirect()->to('/asog-admin')->with('error', 'Google login is not configured yet.');
        }

        $token = $client->fetchAccessTokenWithAuthCode($code);
        if (! is_array($token) || isset($token['error'])) {
            return redirect()->to('/asog-admin')->with('error', 'Google could not verify your account.');
        }

        $client->setAccessToken($token);

        $oauth2         = new Oauth2($client);
        $googleUser     = $oauth2->userinfo->get();
        $email          = strtolower(trim((string) ($googleUser->email ?? '')));
        $googleSub      = trim((string) ($googleUser->id ?? $googleUser->sub ?? ''));
        $googleName     = trim((string) ($googleUser->name ?? ''));
        $givenName      = trim((string) ($googleUser->givenName ?? $googleUser->given_name ?? ''));
        $familyName     = trim((string) ($googleUser->familyName ?? $googleUser->family_name ?? ''));
        $fallbackName   = trim($givenName . ' ' . $familyName);
        $fullName       = $googleName !== '' ? $googleName : $fallbackName;
        $isVerified     = (bool) ($googleUser->verifiedEmail ?? false);

        if ($email === '' || ! $isVerified) {
            return redirect()->to('/asog-admin')->with('error', 'Google email is not verified.');
        }

        if (! $this->isAllowedGoogleDomain($email)) {
            return redirect()->to('/asog-admin')->with('error', 'Google account domain is not authorized.');
        }

        $adminModel = new AdminModel();
        $admin      = $adminModel->findByGoogleAccount($email, $googleSub);

        if ($admin === null) {
            return redirect()->to('/asog-admin')->with('error', 'This Google account is not linked to an authorized admin profile.');
        }

        $updateData = [
            'googleEmail'  => $email,
            'googleSub'    => $googleSub !== '' ? $googleSub : ($admin['googleSub'] ?? null),
            'lastLoginAt' => date('Y-m-d H:i:s'),
        ];

        if ($fullName !== '') {
            $updateData['fullName'] = $fullName;
            $admin['fullName']      = $fullName;
        }

        $adminModel->update($admin['id'], $updateData);

        $this->setAdminSession($admin);

        return redirect()->to('/admin');
    }

    /**
     * Logout the admin user.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/asog-admin')->with('success', 'Logged out successfully.');
    }

    private function buildGoogleClient(): ?GoogleClient
    {
        if (! class_exists(GoogleClient::class)) {
            return null;
        }

        $clientId     = trim((string) env('googleOAuthClientId', ''));
        $clientSecret = trim((string) env('googleOAuthClientSecret', ''));

        if ($clientId === '' || $clientSecret === '') {
            return null;
        }

        $client = new GoogleClient();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $redirectUri = trim((string) env('googleOAuthRedirectUri', ''));
        if ($redirectUri === '') {
            $redirectUri = site_url('asog-admin/google/callback');
        }
        $client->setRedirectUri($redirectUri);
        $client->setAccessType('online');
        $client->setPrompt('select_account');
        $client->setIncludeGrantedScopes(true);
        $client->addScope('openid');
        $client->addScope('email');
        $client->addScope('profile');

        return $client;
    }

    private function setAdminSession(array $admin): void
    {
        session()->set([
            'admin_id'    => $admin['id'],
            'admin_name'  => $admin['fullName'],
            'admin_email' => $admin['email'],
            'admin_role'  => $admin['role'],
            'logged_in'   => true,
        ]);
    }

    private function isAllowedGoogleDomain(string $email): bool
    {
        $rawAllowedDomains = trim((string) env('googleOAuthAllowedDomains', ''));

        if ($rawAllowedDomains === '') {
            return true;
        }

        $allowedDomains = array_values(array_filter(array_map(
            static fn(string $domain): string => strtolower(trim($domain)),
            explode(',', $rawAllowedDomains)
        )));

        if ($allowedDomains === []) {
            return true;
        }

        $emailDomain = strtolower(substr(strrchr($email, '@') ?: '', 1));
        return in_array($emailDomain, $allowedDomains, true);
    }
}
