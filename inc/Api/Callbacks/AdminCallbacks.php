<?php
/**
 * @package supperbrutto
 */

namespace Inc\Api\Callbacks;


use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {

    public function admin_dashboard() {
        return require_once ("$this->plugin_path/templates/admin.php");
    }

    public function option1_callback() {
        return require_once ("$this->plugin_path/templates/admin.php");
    }

    public function option2_callback() {
        return require_once ("$this->plugin_path/templates/admin.php");
    }

    public function supperbrutto_option_group($input) {
        return $input;
    }

    public function supperbrutto_admin_section() {
        echo 'Check this out!';
    }

    public function supperbrutto_text_example() {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '"  placeholder="Write here">';
    }
}