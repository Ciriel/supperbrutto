<?php

/**
 * @package Supperbrutto
 */

class SupperbruttoActivate {
    public static function activate() {
        flush_rewrite_rules();

    }
}