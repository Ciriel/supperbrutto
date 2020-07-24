<?php
/**
 * @package supperbrutto
 */
namespace Inc;

final class Init {
//    store all classes inside array
    public static function get_services() {
        return [
                Pages\Admin::class,
                Base\Enqueue::class,
                Base\SettingsLinks::class
        ];
}

/* loop through classes, initialize them,
   call register method if it exists*/
    public static function register_services() {
        foreach(self::get_services() as $key => $class) {
            $service  = self::instantiate($class);
            if(method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

//    initialize the class
    private static function instantiate($class) {
        return new $class;
    }
}