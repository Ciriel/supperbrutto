<?php

/**
 * @package Supperbrutto
 */

class SupperbruttoDectivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}