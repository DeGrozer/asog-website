<?php

/**
 * Navigation Helper
 * 
 * Provides navigation URL generation for the site header.
 */

if (! function_exists('get_nav_urls')) {
    /**
     * Get all navigation URLs as an array.
     * On the landing page ($isLanding = true) returns # anchors;
     * everywhere else returns full site_url() paths.
     *
     * @param  bool  $isLanding  Whether we are on the landing page
     * @return array Associative array of navigation URLs
     */
    function get_nav_urls(bool $isLanding = false): array
    {
        if ($isLanding) {
            return [
                'about'      => '#about',
                'programs'   => '#programs',
                'facilities' => '#facilities',
                'incubatees' => '#incubatees',
                'news'       => '#news',
                'org'        => '#organization',
                'contact'    => '#contact',
                'cta'        => '#cta',
            ];
        }

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