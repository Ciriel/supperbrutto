<?php

/**
 * Class Admin
 * @package Inc\Pages
 */

namespace Inc\Base;

class Enqueue {
    public function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

        function enqueue() {
        //enqueue all scripts
        wp_enqueue_style( 'mypluginstyle', PLUGIN_URL.'assets/temporary.css');
        wp_enqueue_script( 'mypluginstyle', PLUGIN_URL.'assets/main.js');
    }
}
