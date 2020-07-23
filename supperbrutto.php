<?php
/**
 * @package Supperbrutto
 */
/*
Plugin Name: Superbrutto
Plugin URI: https://xybryzt.pl
Description: Kalkulator obliczajacy superbrutto, brutto, netto oraz skladki pracownika i pracodawcy.
Version: 1.0.0
Author: Speedy&Ciriel
Author URI: https://xybryzt.pl
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: supperbrutto
*/

/*
Superbrutto - calculate netto and brutto of salary
Copyright (C) 2020  Speedy&Ciriel

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.
If not, see <https://www.gnu.org/licenses/>.
*/

defined('ABSPATH') or die('You shall not pass!');

class SuperClass {
    public $plugin_name;

    public function __construct() {
        $this->plugin_name = plugin_basename(__FILE__);
    }

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_filter("plugin_action_links_$this->plugin_name", array($this, 'settings_link'));
    }

    public function settings_link($links) {
        // add custom settings link
        $settings_link = '<a href="admin.php?page=supperbrutto">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    public function add_admin_pages() {
        add_menu_page( 'SupperBrutto', 'SupperBrutto', 'manage_options',
            'supperbrutto', array($this, 'admin_index'), 'dashicons-money', 110 );
    }

    public function admin_index() {
        require_once plugin_dir_path(__FILE__). 'templates/admin.php';
    }
    function uninstall() {
        //delete a CPT
        //delete all data from DB
    }

    function enqueue() {
        //enqueue all scripts
        wp_enqueue_style( 'mypluginstyle', plugins_url('/assets/main.css'),__FILE__);
        wp_enqueue_script( 'mypluginstyle', plugins_url('/assets/main.js'),__FILE__);
    }

    function activate() {
        require_once plugin_dir_path(__FILE__). 'inc/supperbrutto-activate.php';
        SupperbruttoActivate::activate();
    }
}

if(class_exists('SuperClass')) {
    $supper_class = new SuperClass();
    $supper_class -> register();
}

//activation
register_activation_hook( __FILE__, array($supper_class, 'activate') );

//deactivation
require_once plugin_dir_path(__FILE__). 'inc/supperbrutto-deactivate.php';
register_deactivation_hook( __FILE__, array('SupperbruttoDeactivate', 'deactivate') );