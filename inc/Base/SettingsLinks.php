<?php


/**
 * @package supperbrutto
 */

namespace Inc\Base;

class SettingsLinks {
    protected $plugin;
    public function __construct() {
        $this -> plugin = PLUGIN;
    }

    public function register() {
        add_filter("plugin_action_links_".PLUGIN, array($this, 'settings_lins'));
    }

    public function settings_lins($links) {
        $settings_link = '<a href="admin.php?page=supperbrutto">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}