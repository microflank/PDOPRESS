<?php
/**
 * Created by PhpStorm.
 * User: JOREXZOFLANK
 * Date: 11/22/14
 * Time: 9:59 PM
 */

return array(
	
	'default_database' => 'mysql',
	
	'default_conn' => 'default',
	
	'databases'	=>	array(
												'mysql'	=> array(
																"default" =>  array(
																						'dsn'       => 'mysql:dbname=mvc;host=localhost',
																						'host'      => 'localhost',
																						'user'      => 'root',
																						'database'  => 'mvc',
																						'password'  => '',
																),
												),
												
						),
						
    'debug' => true,

    /*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer set of commands than a typical key-value systems
	| such as APC or Memcached. micro_mvc makes it easy to dig right in.
	|
	*/

    'redis' => array(

        'cluster' => false,

        'default' => array(
            'host'     => '127.0.0.1',
            'port'     => 6379,
        ),

    ),

    'default_controller'   => 'welcome',
    'default_method'   => 'index',
    'no_method_error' => "false",

);