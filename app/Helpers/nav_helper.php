<?php

/**
 * Navigation Helper
 * 
 * Provides navigation URL generation for the site header.
 */

if (! function_exists('get_nav_urls')) {
    /**
     * Get all navigation URLs as an array.
     * 
     * @return array Associative array of navigation URLs
     */
    function get_nav_urls(): array
    {
        return [
            // ── About Us ──
            'about'      => site_url('about'),

            // ── Programs & Services ──
            'programs'   => site_url('programs'),
            'facilities' => site_url('programs'),

            // ── Incubatees ──
            'incubatees' => site_url('incubatees'),

            // ── News & Insights ──
            'news'       => site_url('news'),

            // ── Contact Us ──
            'contact'    => site_url('contact'),

            // ── CTA ──
            'cta'        => site_url('be-an-incubatee'),
        ];
    }
}