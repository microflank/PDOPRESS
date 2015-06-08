<?php

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

);