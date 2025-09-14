<?php
//controller have the method
//for specific url in routes
//It generates the view for each method
class HomeController{


    public function index()
    { 
        
        // $database = Database::getInstance();
        // $conn = $database->getConnection();
     
        // $message="message passed from homecontroller's index method";
    //    require_once __DIR__.'/../views/home/index.php';
    //     $request="about";
    //     $query=[
    //         "Name"=>"Gintoki",
    //         "Age"=>25,
    //         "city"=>"Japan Tokyo"
    //     ];
    //  redirect($request,$query);
 
    $data=[
        'title'=>'Home Page',
        'message'=>'Welcome to Home Page',
    ];
    

     //parameter :url , data and layout
    render('/home/index',$data);
    }

    public function about()
    { 
        // $message="message passed from homecontroller's index method";
    //    require_once __DIR__.'/../views/home/index.php';
  
    $data=[
        'title'=>'About Page',
        'message'=>'Welcome to About Page',
    ];
    

      //parameter :url , data and layout
    render('/home/about',$data);
    }
    
    public function contact()
    { 
        // $message="message passed from homecontroller's index method";
    //    require_once __DIR__.'/../views/home/contact.php';
  
    $data=[
        'title'=>'Contact Page',
        'message'=>'Welcome to contact Page',
    ];
    
    //parameter :url , data and layout
    render('home/contact',$data);
    }
  
}



?>