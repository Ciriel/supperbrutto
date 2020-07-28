<?php

/**
 * Class Admin
 * @package Inc\Pages
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController{
    public $settings;
    public $pages = array();
    public $subpages = array();
    public $callbacks;

    public function register() {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->set_pages();
        $this->set_subpages();

        $this->set_settings();
        $this->set_sections();
        $this->set_fields();

        $this->settings
            ->add_pages($this->pages)
            ->with_subpage('Option 0')
            ->add_subpages($this->subpages)
            ->register();
    }

    public function set_pages() {
        $this -> pages = array(
            array(
                'page_title' => 'SupperBrutto',
                'menu_title' =>'SupperBrutto',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto',
                'callback' => array($this->callbacks, 'admin_dashboard'),
                'icon_url' => 'dashicons-money',
                'position' => 110
            )
        );
    }

    public function set_subpages() {
        $this -> subpages = array(
            array(
                'parent_slug' => 'supperbrutto',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'Option 1',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto_cpt',
                'callback' => array($this->callbacks, 'option1_callback')
            ),
            array(
                'parent_slug' => 'supperbrutto',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Option 2',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto_widget',
                'callback' => array($this->callbacks, 'option2_callback')
            )
        );
    }

    public function set_settings() {
        $args = array(
            array(
                'option_group' => 'supperbrutto_options_group',
                'option_name' => 'text_example',
                'callback' => array($this->callbacks, 'supperbrutto_option_group')
            )
        );
        $this->settings->set_settings($args);
    }

    public function set_sections() {
        $args = array(
            array(
                'id' => 'supperbrutto_admin_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'supperbrutto_admin_section'),
                'page' => 'supperbrutto'
            )
        );
        $this->settings->set_sections($args);
    }

    public function set_fields() {
        $args = array(
            array(
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array($this->callbacks, 'supperbrutto_text_example'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )
            )
        );
        $this->settings->set_fields($args);
    }
}