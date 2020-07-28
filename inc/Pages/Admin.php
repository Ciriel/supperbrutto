<?php

/**
 * Class Admin
 * @package Inc\Pages
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController{
    public $settings;
    public $pages = array();
    public $subpages = array();
    public $callbacks;
    public $callbacks_manager;

    public function register() {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->callbacks_manager = new ManagerCallbacks();

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
                'callback' => array($this->callbacks_manager, 'option1_callback')
            ),
            array(
                'parent_slug' => 'supperbrutto',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Option 2',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto_widget',
                'callback' => array($this->callbacks_manager, 'option2_callback')
            )
        );
    }

    public function set_settings() {
        $args = array(
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'cpt_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'taxonomy_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'media_widget',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'galery_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'testimoniam_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'template_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'login_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'membership_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            ),
            array(
                'option_group' => 'supperbrutto_settings',
                'option_name' => 'chat_manager',
                'callback' => array($this->callbacks_manager, 'checkbox_sanitize')
            )

        );
        $this->settings->set_settings($args);
    }

    public function set_sections() {
        $args = array(
            array(
                'id' => 'supperbrutto_admin_index',
                'title' => 'Settings Manager',
                'callback' => array($this->callbacks_manager, 'admin_section_manager'),
                'page' => 'supperbrutto'
            )
        );
        $this->settings->set_sections($args);
    }

    public function set_fields() {
        $args = array(
            array(
                'id' => 'cpt_manager',
                'title' => 'Activate CPT Manager',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'cpt_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'taxonomy_manager',
                'title' => 'Jestem Zajebisty',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'taxonomy_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'media_widget',
                'title' => 'O tak i to jak bardzo',
                'callback' => array($this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'media_widget',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'gallery_manager',
                'title' => 'Activate Gallery Manager',
                'callback' => array( $this->callbacks_manager, 'checkbox_field' ),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'gallery_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'testimonial_manager',
                'title' => 'Activate Testimonial Manager',
                'callback' => array( $this->callbacks_manager, 'checkbox_field' ),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'testimonial_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'templates_manager',
                'title' => 'Activate Templates Manager',
                'callback' => array( $this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'templates_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'login_manager',
                'title' => 'Activate Ajax Login/Signup',
                'callback' => array( $this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'login_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'membership_manager',
                'title' => 'Activate Membership Manager',
                'callback' => array( $this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'membership_manager',
                    'class' => 'ui-toggle'
                )
            ),
            array(
                'id' => 'chat_manager',
                'title' => 'Activate Chat Manager',
                'callback' => array( $this->callbacks_manager, 'checkbox_field'),
                'page' => 'supperbrutto',
                'section' => 'supperbrutto_admin_index',
                'args' => array(
                    'label_for' => 'chat_manager',
                    'class' => 'ui-toggle'
                )
            )
        );
        $this->settings->set_fields($args);
    }
}