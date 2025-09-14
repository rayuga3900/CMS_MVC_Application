 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo  base_url('/')?>">Home</a>
            </li>
            <?php if(!isLoggedIn()): ?>
                <!-- if user is not logged in show login button -->
        
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url("user/login") ?>">Login</a>
            </li>
            <!-- if user is logged in show the admin button -->
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('dashboard') ?>">Admin</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('about') ?>">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url("contact") ?>">Contact</a>
            </li>
          
           
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('user/register') ?>">Register</a>
            </li> 
           
        </ul>
   
</nav>