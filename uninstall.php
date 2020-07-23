<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package supperbrutto
 */

if( ! defined( 'WP_UNINSTLL_PLUGIN' ) ) {
    die;
}

//clear db sotred data
$supperBruttos = get_posts( array('post_type' => 'supperbrutto', 'numberposts' => -1) );

foreach( $supperBruttos as $supperBrutto ) {
    wp_delete_post($supperBrutto->ID, true);
}

//// acces the db via SQL
//global $wpdb;
//$wpdb -> query("DELETE FROM wp_posts WHERE post_type = 'book'");
//$wpdb -> query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FRPM wp_posts)");
//$wpdb -> query("DELETE FROM wp_term_relationships WHERE post_id NOT IN (SELECT id FRPM wp_posts)");
