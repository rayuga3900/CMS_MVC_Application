<?php
// This file is main entry point for the
//  web application, handling requests and routing.

require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';
//rtrim() to remove characters from right side
//from the end(trailing)
//$_GET['url'] to get things from url
// $request=isset($_GET['url'])?rtrim($_GET['url'],'/'):'';


$request = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
//$_SERVER['REQUEST_URI']->this will give everything 
//after the hostname like path and querystring
//parse_url()->it breaks url into the associative array
//you can use keys to get the components of url

// PHP_URL_PATH->with help of this parameter
//you can access path portion of url rather than
//parsing the entire url


$method = $_SERVER['REQUEST_METHOD'];

//method=GET/POST and request are predfined urls
//that are there in the routes
//routes is multidimensonal array
//routes[POST][/user/register]
//we have includes routes file so thats why
//we are able to use it here
    if(isset($routes[$method][$request]))
    {
        
//list() is used to unpack array
//values into individual variables
    list($controller,$action) = explode('@',$routes[$method][$request]);

    require_once __DIR__. '/../app/controllers/' . $controller . '.php';

    $controllerInstance = new $controller();

    $controllerInstance -> $action();
    // var_dump($controller);
    // echo '<br>';
    // var_dump($action);
    // echo "ok";
    // echo "<pre>";
    // var_dump($uri);
    // echo "</pre>"
    }
    else{
        http_response_code(404);
        echo "404 Not found";
    }

//testing whether init is included properly
//by trying to use autoload function
// $test=new Test();
// var_dump(get_declared_classes());


//we are getting $routes from routes/web.php
//routes have predefined actions or contents based 
// on predefined urls
//urls are the keys and actions are values in routes

//so here we are checking whether the url is there in route
//or not so we can do specific actions
// if(array_key_exists($request,$routes))
// {
//     //separating the data in request(string format)


//     //explode function converts string into array 
//     //it takes a delimiter that indicates where to split
//     $route=explode('@',$routes[$request]);
//     $controllerName = $route[0];//class which will handle thath route

//     $methodName = $route[1];//Method of the class (controller)

//     $controller = new $controllerName();
//      //autoloading class and autoloaders also check
//      //whether class exist or not
//     $controller -> $methodName();
    
    // echo "<pre>";
    // print_r($route);
    // echo "</pre>";
    // var_dump($routes[$request]);
    // echo "True it does exist";
// }
// else{
//     echo "404-page not found";
// }
?>