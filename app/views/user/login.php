 
 <div class="row justify-content-center">
<div class="col-md-6">
    <form method="POST" action="<?php echo base_url("/login"); ?>">
    
    <h2>Login</h2>
<div class="mb-3">
        <label class="form-label"for="email">Email address:</label>
        <input name="email"class="form-control"value="<?php echo isset($email) ? $email : ''; ?>"  placeholder="Enter your email address" type="email"   required>
        <br><br>
         
        <label class="form-label"for="password">Password:</label>
        <input name="password"class="form-control"placeholder="Enter your password"  type="password" name="password" required>
        <br><br>
        
        <input type="submit" class="btn btn-primary w-100"value="Login">
    </form>
    <p class="mt-3 text-center">
                  Don't have an account? <a href="<?php echo base_url("user/register"); ?>">Register here</a>.
                </p>
    </div>
</div>
</div>
 
