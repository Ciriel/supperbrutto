<?php


/**
 * @package supperbrutto
 */

namespace Inc\Base;
use \Inc\Base\BaseController;

class SettingsLinks extends BaseController {
    public function register() {
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_lins'));
    }

    public function settings_lins($links) {
        $settings_link = '<a href="admin.php?page=supperbrutto">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}