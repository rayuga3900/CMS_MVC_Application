<?php
class UserController
{
    private $userModel;
    public function __construct()
    {
        //creating object of user model
        //so that we can use the database
        //manipulation
        $this->userModel = new User();
    }

    public function showRegisterForm()
    {
        $data = [
            'title'=>'Register',
        ];
        render('user/register',$data);
    
    }
    public function register()
    {
        // var_dump($_POST);
        $user = new User();
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if($user->store())
        {
            redirect('/');
        }
        else
        {
            echo "There was an error";
        }
    }
    public function showProfile()
    {
        $userId = $_SESSION['user_id'];

        $user = $this->userModel->getUserById($userId);

        // var_dump($user);
        $data = [
            'title'=>'Profile',
            'user' => $user,
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'birthday' => $user->birthday,
            'organization' => $user->organization,
            'location' => $user->location,
            'profile_image' => $user->profile_image
        ];
        render('/admin/users/profile',$data,'layouts/admin_layout');
     
    }
    public function updateProfile()
    {
        $userId = $_SESSION['user_id'];
        //if no value given assign no value
        //get the form data
        $first_name = sanitize($_POST['first_name'] ?? '');
        $last_name = sanitize($_POST['last_name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $phone = sanitize($_POST['phone'] ?? '');
        $birthday = sanitize($_POST['birthday'] ?? '');
        $organization = sanitize($_POST['organization'] ?? '');
        $location = sanitize($_POST['location'] ?? '');
         
        //convert form data into array for updating multiple data
        $userData = [
           
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'birthday' => $birthday,
            'organization' =>  $organization,
            'location' =>  $location
            
        ];

        if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK)
        {
            // $imagePath = false;
            $imagePath = $this->userModel->handleImageUpload($_FILES['profile_image']);
            if($imagePath)
            {
                $userData['profile_image'] = $imagePath;
            }
            else
            {
                setSessionMessage('error', 'Failed to upload image For some reason');

                redirect('/admin/users/profile');
            }
        }
        
        $updateStatus = $this->userModel->update($userId, $userData);
        
        if($updateStatus)
        {
         setSessionMessage('message', 'Profile updated Succcessfully');

         //the below code is used to show the active tab
         $_SESSION['active_tab'] = '#settings';

        }
        else
        {
            setSessionMessage('error', 'Failed to update the profile');
 
        }
        redirect('admin/users/profile');

    }

    public function updateUserProfilePassword()
    {
        $userId = $_SESSION['user_id'];

        $newPassword = sanitize($_POST['new_password'] ?? '');
        $confirmPassword = sanitize($_POST['confirm_password' ]?? '');
        
        if(empty($newPassword) || empty($confirmPassword))
        {
            setSessionMessage('error', 'Please fill all the required field');
            redirect('/admin/users/profile');
        }
        if($newPassword !== $confirmPassword)
        {
            setSessionMessage('error', 'Passwords do not match');
            redirect('/admin/users/profile');
        }
        
        $updateStatus = $this->userModel->updatePassword($userId, $newPassword);
        
        if($updateStatus)
        {
            setSessionMessage("message", "Password updated successfully");
            $_SESSION['active_tab'] = '#password';
        }
        else
        {
            setSessionMessage('error', 'Failed to update the password');
        }
        redirect('/admin/users/profile');
    }
    
    public function showLoginForm()
    {
        $data = [
            'title'=>'Login',
        ];
        render('user/login',$data);
    
    }
    public function loginUser()
    {
        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];
        
        if($this->userModel->login())
        {
            $_SESSION['user_id'] = $this->userModel->id;
            $_SESSION['username'] = $this->userModel->username;
            $_SESSION['first_name'] = $this->userModel->first_name;
            $_SESSION['last_name'] = $this->userModel->last_name;
            redirect('/dashboard');
        }
        else
        {
            echo "There was an error";
        }
    }
    

    public function logout()
    {
        $_SESSION=[];
        session_destroy();
        redirect('/user/login');
    }

    
    public function test($id)
    {
    //    var_dump($this->userModel->getUserById($id));
    }
}


?>