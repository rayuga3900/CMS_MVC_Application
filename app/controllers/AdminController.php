<?php

class AdminController
{
    public function __construct()
    {
        
    }
    public function dashboard()
    {
     AuthMiddleware::requiredLogin();
        $data=[
            'title'=>'Dashboard',
            'message'=>'Welcome to Admin dashboard',
        ];
        
    
        //parameter :url and data
        render('admin/dashboard',$data,'layouts/admin_layout');
       
    }

    public function admin()
    {
        AuthMiddleware::requiredLogin();
        $data=[
            'title'=>'Dashboard',
            'message'=>'Welcome to Admin dashboard',
        ];
        
    
        //parameter :url and data
        render('admin/index',$data,'layouts/admin_layout');
        
    }
}


?>