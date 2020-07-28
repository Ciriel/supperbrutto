<?php
/**
 * @package supperbrutto
 */

namespace Inc\Api\Callbacks;


use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController {

    public function checkbox_sanitize($input) {
        return isset($input);
    }

    public function admin_section_manager() {
        echo 'Activate the sections and features of supperbrutto plugin.';
    }

    public function checkbox_field($args) {
        $name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option($name);
        echo '<input type="checkbox" name="' . $name . '" value="1" class="' . $classes . '" ' . ($checkbox ? 'checked' : '') .'>';
    }
}