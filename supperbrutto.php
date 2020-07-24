<?php
/**
 * @package supperbrutto
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

use Inc\Base\Activate;
use Inc\Base\Deactivate;

defined('ABSPATH') or die('You shall not pass!');

if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

//define CONSTANTS
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

function activate_supperbrutto() {
    Activate::activate();
}

function deactivate_supperbrutto() {
    Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_supperbrutto');
register_deactivation_hook(__FILE__, 'deactivate_supperbrutto');

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}