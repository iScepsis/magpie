<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 03.09.2018
 * Time: 12:45
 */

namespace src\Components;


use Slim\Container;

class DependenciesProvider
{
    public static $slim;
    public static $settings;
    public static $db;

    /**
     * @param Container $c
     * @throws \Interop\Container\Exception\ContainerException
     */
    public static function init(Container $c){
        self::$slim = $c;
        self::$settings = $c->get('settings');
        self::$db = $c->get('db');

    }
}