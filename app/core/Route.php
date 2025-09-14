<?php

    class Route
    {
        protected $routes = [
            'GET' => [],
            'POST' => [],
        ];

        //get and post methods are defining routes and handlers

        //defines  route for the url with dynamic parts with request method as GET 
        public function get($path, $handler)
        {
             
            //defining the routes
            // $this->routes['GET'][$path] is an array element
            // which holds  $handler(callable) this as a value
            $this->routes['GET'][$this->formatRoute($path)] = $handler;
            // var_dump( $this->routes['GET'][$path]);
        }

        //defines  route for the url with dynamic parts with request method as POST 
        public function post($path, $handler)
        {
            $this->routes['POST'][$this->formatRoute($path)] = $handler;
           
        }
        protected function formatRoute($route)
        {
            //if input is /user/test/ output will be /user/test
             return  '/'.trim($route, '/');
        }
        

        //below function is used to match incoming request with
        // defined routes (which has dynamic segments) and also get the dynamic segments of the url


        //we create a pattern with capture groups(defined by parenthesis ()) for each defined route
        //and later we try to match the pattern with request
        // and that's how we get the dynamic part of the url


        //Main purpose is to extract the dynamic part of the url
        public function dispatch()
        {
            //getting the method like post or get
            $method = $_SERVER['REQUEST_METHOD'];
            //getting the path ike /user/test
            $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            //cleaning the path to get rid of extra  slashes
            $cleanedRequest = $this->formatRoute($requestUri);
           if($this->match($method, $cleanedRequest))
           {
            //this handler is an array holding the handler and parameters
            $handler = $this->match($method, $cleanedRequest);

            list($controller, $action) = explode('@', $handler['handler']);
            $params = $handler['params'];

            $this->callAction($controller, $action, $params);
           }
           
        }
        //Below method returns the handler and the parameter

        //method overview
        //we pass the method(GET/POST) and the URI(/user/test/{id})
        //foreach of the route with the specified method(GET/POST)
        //we replace their dynamic section of url i.e {id},{username},...,etc with the capture group[(a-zA-Z0-9_)+]
        //to create a regex pattern
        //then we compare the actual URI with regex pattern to get the dynamic part of the url
        public function match($method, $requestUri)
        {
            //code won't work if root route('/') is placed first
            //because '/' and [ '/about' or '/contact',/..] in preg_match 
            //are matching with each other so root handler is assigned to other routes aas well
            foreach($this->routes[$method] as $route => $handler)
            {
               //#->used as delimiter which defines the beginning and 
               //the end of the pattern that will match
               //[]->it defines range
               //+ ->to much one or more appearance of that else it will match just once
               //\->this is used as escape character to tell programming language thath we mean something else
               //like we want to match . but it is operator in php so we escape it
               //to use it 

               //preg_replace(pattern, replacement, subject)
               //which pattern to search in subject for replacing with replacement.


               //we replace the dynamic segment of the url with regex capture group
               //that allow us to capture the dynamic part of the url 
               //like /user/test/{id} is converted to /user/test/([a-zA-Z0-9_]+)
               
              $pattern = preg_replace('#\{[a-zA-Z0-9_]+}#', '([a-zA-Z0-9_]+)', $route);
              //if match not found preg_replace will not modify the string in any way(for url without dynamic parts)
             //and hold the Path (like /contact, /about)
             
             
            //  uncomment this for debugging
            //request may come different like /user/register
            //but pattern generated is / only if i put root route at the beginning
    
              //output of $pattern: string(26) "/user/test/([a-zA-Z0-9_]+)"
                
              //we match the cleanedRequest with the generated pattern 
              if(preg_match('#'.$pattern.'#', $requestUri, $matches))
              {
                //preg_match('/','/about',$matches) giving result 1 and the /about is assigned
                //the HomeController@index method 
                //if match is found then the dynamic part is captured in the $matches
                //it takes the element off from the beginnig of the array
                //in this case it will remove the uri and only parameter will remain there
                array_shift($matches);
                return [
                    'handler' => $handler,
                    'params' =>$matches,
                ];
              }
            }
           return false;
        }

        protected function callAction($controller, $action, $params = [])
        {
           require_once base_path('/app/controllers')  . '/'. $controller .'.php';

            $controllerInstance = new $controller();
            //below function is used in mvc systems to call controller's action
            //dynamically
            //when one of route is matched router is going to identify
            //the controller method
            call_user_func_array([$controllerInstance, $action], $params);
            
        }
    }



?>