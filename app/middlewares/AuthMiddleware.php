<?php
//this file  checks whether user is authenticated 
//or not before
class AuthMiddleware{

    public static function isAuthenticated()
    {
        //checking if session is not started
        if(session_status() == PHP_SESSION_NONE)
        {
            //then starting session
            session_start();
        }
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    public static function requiredLogin()
    {
         
        if(!self::isAuthenticated())
        {
           redirect('user/login');
        }
       
    }
}

?>