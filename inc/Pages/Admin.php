<?php

/**
 * Class Admin
 * @package Inc\Pages
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController{
    public $settings;
    public $pages = array();
    public $subpages = array();

    public function __construct() {
        $this->settings = new SettingsApi();

        $this -> pages = [
            [
                'page_title' => 'SupperBrutto',
                'menu_title' =>'SupperBrutto',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto',
                'callback' => function() {
                    echo '<h1>Helloo!</h1>';
                },
                'icon_url' => 'dashicons-money',
                'position' => 110
            ]
        ];

        $this -> subpages = [
            [
                'parent_slug' => 'supperbrutto',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'Option 1',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto_cpt',
                'callback' => function() {
                    echo '<h1>Option1 Hello!</h1>';
                }
            ],
            [
                'parent_slug' => 'supperbrutto',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Option 2',
                'capability' => 'manage_options',
                'menu_slug' => 'supperbrutto_widget',
                'callback' => function() {
                    echo '<h1>Option2 Hello!</h1>';
                }
            ]
        ];
    }

    public function register() {
        $this->settings
            ->add_pages($this->pages)
            ->with_subpage('Option 0')
            ->add_subpages($this->subpages)
            ->register();
    }
}