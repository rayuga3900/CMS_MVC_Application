<?php
//this file is for initial setup and configuration
//it includes session management,autoloading classes
 
session_start();

//going one directory up from current directory
//where script is running(app) then going into config

$config=require_once __DIR__."/../config/config.php";

if(!defined('BASE_URL'))
{
    define('BASE_URL',$config['app']['base_url']);
}
require_once __DIR__."/../config/database.php";

require_once __DIR__."/helpers.php";

// echo __DIR__."\..\config\database.php";

spl_autoload_register(function ($class_name){
    $paths=[
            __DIR__.'/controllers/',
            __DIR__.'/models/',
            __DIR__.'/middlewares/',
            __DIR__.'/core/',
        ];
        //autoloading classes from controllers and\
        //models directory
        foreach($paths as $path)
        {
            //creating the filepath to the class
            $file=$path.$class_name.'.php';
            //checking if file exists
            if(file_exists($file))
            {
                //if exist then including it 
                require_once $file;
                return;
            }
        }
});
?>