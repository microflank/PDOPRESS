<?php

namespace PDOpress;

class Configuration {

    protected static $config = array();

    public static $_instance= null;

    public function __construct()
    {
        if (self::$_instance == null) {
            self::$_instance = $this;
        }

        return self::getInstance();
    }

    public static function set_config(array $configs)
    {
        if (self::$_instance == null) {

            self::$_instance = new Configuration();
        }

        self::$config = $configs;
    }

    public static function getInstance(){

        return self::$_instance;
    }

    public static function getConfig($key)
    {
        $key = trim($key);

        return isset(self::$config[$key])? self::$config[$key] : false;
    }

    public static function setConfig($key, $data)
    {
        self::$config[$key] = trim($data);
    }

}

/**
 *System configuration parameters required for system booting
 */
$configuration = require_once('config.php');

Configuration::set_config($configuration);