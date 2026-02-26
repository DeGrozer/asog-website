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
            'about'      => site_url('about'),
            'programs'   => site_url('programs'),
            'facilities' => site_url('facilities'),
            'incubatees' => site_url('incubatees'),
            'news'       => site_url('news'),
            'org'        => site_url('organization'),
            'contact'    => site_url('contact'),
            'cta'        => site_url('contact'),
        ];
    }
}
