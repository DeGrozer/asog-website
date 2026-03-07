<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Honeypot extends BaseConfig
{
    /**
     * Makes Honeypot visible or not to human
     */
    public bool $hidden = true;

    /**
     * Honeypot Label Content
     */
    public string $label = 'Website URL';

    /**
     * Honeypot Field Name
     */
    public string $name = 'website_url';

    /**
     * Honeypot HTML Template
     * autocomplete="off" prevents browsers from auto-filling
     * tabindex="-1" prevents keyboard users from reaching it
     */
    public string $template = '<label>{label}</label><input type="text" name="{name}" value="" autocomplete="off" tabindex="-1">';

    /**
     * Honeypot container — CSP-safe (no inline style, hidden via CSS)
     */
    public string $container = '<div id="{id}">{template}</div>';

    /**
     * The id attribute for Honeypot container tag
     */
    public string $containerId = 'hpc';
}