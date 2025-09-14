<?php
//Routes are essential for directing 
//user requests to the appropriate handlers in a web application

//this routes are there to handle 
// the (GET, POST, PUT, DELETE, etc.). request


$router = new Route();

$router->get('/user/test/{id}',   'UserController@test');

$router->get('/contact',  'HomeController@contact');
$router->get('/about',  'HomeController@about');
$router->get('/user/register',  'UserController@showRegisterForm');
$router->get('/user/login',  'UserController@showLoginForm');
$router->get('/dashboard',  'AdminController@dashboard');
$router->get('/admin/users/profile',  'UserController@showProfile');
$router->get('/admin',   'AdminController@admin');

$router->get('/index','HomeController@index');
$router->get('/',  'HomeController@index');//keep the root route at the end
//so that all specific routes are checked instead of directly
//matching with the root route

$router->post('/register','UserController@register');
$router->post('/login','UserController@loginUser');
$router->post('/logout','UserController@logout');
$router->post('/admin/user/update','UserController@updateProfile');
$router->post('/admin/profile/user/password/update','UserController@updateUserProfilePassword');



//below route technique can only work for predefined routes wihth no   dynamic sections in url(like /user/{id})
//routes link whatever is there in url to specific actions in application
// $routes=[
//     'GET'=>[
//         '/'=>'HomeController@index', //maps root url to HomeController's index method
//         '/contact'=>'HomeController@contact',
//         '/about'=>'HomeController@about', //maps about url to HomeController's about method
//        '/user/register'=>'UserController@showRegisterForm',
//        '/user/login'=>'UserController@showLoginForm',
//        '/dashboard'=>'AdminController@dashboard',
//        '/admin'=>'AdminController@admin',
//        '/admin/users/profile'=>'UserController@showProfile',
      
//     ],
//     'POST' =>[
//         '/register'=>'UserController@register',
//         '/login'=>'UserController@loginUser',
//         '/logout'=>'UserController@logout',
//         '/admin/user/update'=>'UserController@updateProfile',
//         '/admin/profile/user/password/update'=>'UserController@updateUserProfilePassword'  
//     ]
// ];
   // @ symbol serves as a separator between the controller 
// class and the method that should be executed.
 
?>