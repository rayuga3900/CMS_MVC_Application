 
<!-- This is index page of the application -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login App with SQL and PHP</title>
<link rel='stylesheet' href='<?php echo base_url('css/style.css'); ?>'>
 
</head>
 
<body class="index"> 
 
 
 <!-- Navigation bar  -->
  <?php require  views_path('partials/home/navbar.php') ?>

  
    <div class='container'>
    <div class="hero">
        <div class="hero-content">
            <h1>Welcome to our PHP login  app</h1>
            <p>Securely login and manage your account with us</p>
            <div class="hero-buttons"> 
                <!-- if user is not logged in then we want them to see the login and register button -->
      
                <a class="btn"href="<?php echo base_url('user/login');?>">Login</a>
                <a class="btn"href="<?php echo base_url('user/register');?>">Register</a>
                
            </div>
        </div>

    </div>
    
</div>
</body>
</html>
 