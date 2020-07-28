<?php

/**
 * Class Admin
 * @package Inc\Pages
 */

namespace Inc\Base;
use \Inc\Base\BaseController;

class Enqueue extends BaseController{
    public function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

        function enqueue() {
        //enqueue all scripts
        wp_enqueue_style( 'mypluginstyle', $this->plugin_url.'assets/temporary.css');
        wp_enqueue_script( 'mypluginstyle', $this->plugin_url.'assets/myscript.js');
    }
}
