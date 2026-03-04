<?php

/**
 * JS Helper — outputs common JavaScript variables for use in views.
 *
 * Usage in views:
 *   <?= jsBaseUrl() ?>
 *   <!-- outputs: <script>var APP_BASE_URL = 'http://...';</script> -->
 *
 * Then in any JS file:
 *   function siteUrl(path) {
 *       var base = window.APP_BASE_URL || window.location.origin;
 *       return base.replace(/\/$/, '') + '/' + path;
 *   }
 */

if (! function_exists('jsBaseUrl')) {
    /**
     * Output a <script> tag that sets APP_BASE_URL for JavaScript consumption.
     */
    function jsBaseUrl(): string
    {
        $base = rtrim(site_url(), '/');
        return '<script>var APP_BASE_URL = ' . json_encode($base) . ';</script>';
    }
}
