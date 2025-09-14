<?php
// This file is main entry point for the
//  web application, handling requests and routing.

//because of this file the init
//and routes are accessible throughout the
//application
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';
//rtrim() to remove characters from right side
//from the end(trailing)
//$_GET['url'] to get things from url
// $request=isset($_GET['url'])?rtrim($_GET['url'],'/'):'';


 $router->dispatch();


?>