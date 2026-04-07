
# asog-website
A website for the CSPC ASOG TBI

# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Google Login for Admin

1. Install dependencies:
   - Run `composer install` (or `composer update` if already installed).
2. In Google Cloud Console:
   - Create an OAuth 2.0 Client ID (Web application).
   - Add Authorized redirect URI:
     - `http://localhost:8080/asog-admin/google/callback`
     - `https://asogtbi.com/asog-admin/google/callback`
3. In your `.env`, set:
   - `googleOAuthClientId="YOUR_GOOGLE_CLIENT_ID"`
   - `googleOAuthClientSecret="YOUR_GOOGLE_CLIENT_SECRET"`
   - Optional domain restriction (comma-separated):
     - `googleOAuthAllowedDomains="gmail.com,example.edu.ph"`
   - Use `app.baseURL = 'http://localhost:8080/'` for local testing and `app.baseURL = 'https://asogtbi.com/'` on Hostinger.
4. Authorization rule:
   - Only Google accounts with verified email that already exist as active records in the `admins` table can sign in.

## Google Admin Authorization Schema

The `admins` table now supports explicit Google account linking:

- `googleEmail` - the Google account email allowed to sign in.
- `googleSub` - the stable Google account identifier returned by OAuth.

For existing installs, run the new migration and then set these values for the admin row you want to authorize.

### Manage Admin Google Authorization

#### Via Admin Dashboard
1. Go to **Admins** menu in the admin panel.
2. Click **Edit** on an admin account.
3. Enter the Google email address and optionally the Google Sub ID.
4. Save changes.

#### Via Direct SQL

**Authorize an admin to use Google OAuth:**
```sql
UPDATE admins 
SET googleEmail = 'admin@gmail.com' 
WHERE email = 'admin@yourdomain.com';
```

**Authorize with both email and stable Google Sub ID (more secure):**
```sql
UPDATE admins 
SET 
  googleEmail = 'admin@gmail.com',
  googleSub = '1234567890123456789'
WHERE email = 'admin@yourdomain.com';
```

**Remove Google authorization from an admin:**
```sql
UPDATE admins 
SET googleEmail = NULL, googleSub = NULL 
WHERE email = 'admin@yourdomain.com';
```

**List all admins and their Google authorization status:**
```sql
SELECT id, fullName, email, googleEmail, googleSub, isActive, lastLoginAt 
FROM admins 
ORDER BY createdAt DESC;
```

**Deactivate an admin account:**
```sql
UPDATE admins 
SET isActive = 0 
WHERE email = 'admin@yourdomain.com';
```

### Finding Your Google Account Sub ID

To find your Google account's stable **Sub ID**:
1. Sign in to your app using Google OAuth.
2. Check the application logs or error output for the OAuth token details.
3. The `sub` claim in the token is your Google Sub ID.
4. Alternatively, you can leave it blank and just use `googleEmail` for simpler setups.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.2 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - The end of life date for PHP 8.1 was December 31, 2025.
> - If you are still using below PHP 8.2, you should upgrade immediately.
> - The end of life date for PHP 8.2 will be December 31, 2026.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
=======
# asog-website
A website for the CSPC ASOG TBI
