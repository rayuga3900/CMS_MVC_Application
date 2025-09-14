<?php
//general configuration 
return [
        'database' => [
            'host'      => 'localhost',
            'database'  => 'mvc_app_db',
            'username'  => 'root',
            'password'  => '',
            'port'      => 3306,
            'charset'   => 'utf8mb4'
        ],
        'app'      => [
            'base_url'  => 'http://mvc_app.local/',
            'debug'     => true,
        ]
    ];


//dont put https in localhost or
//  you will get the your connection 
// isn't private error

// const BASE_URL="http://mvc_app.local/";

 
?>