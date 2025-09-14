<?php

class user{
    private $table='users';
    private $uploadDir = 'uploads/users/';
    public $id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $birthdate;
    public $organization;
    public $location;
    public $profile_image;
    public $created_at;
    public $updated_at;
    
    private $conn;

    public function __construct()
    {
        $this -> conn = Database::getInstance()->getConnection();

    }
    public function getUserById($userId)
    {
        $query = "Select * from users where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function update($userId, $userData)
    {
        $fields = [];

        foreach($userData as $key => $value)
        {
            $fields[] = "{$key} = :{$key}";
        //it will store column name and placeholder
        //it will make fields like first_name = : first_name
        }
        //implode we have used , and space to have space between columns 
        //$fields = ['first_name = :first_name', 'last_name = :last_name']

        $query = "update $this->table set ". implode(', ', $fields) . " where id = :id";
        
        // print_r($query);
        // echo "<br>";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":id", $userId, PDO::PARAM_INT);

        foreach($userData as $key => $value)
        {
            //if value is empty then put null
            if($value === '')
            {
                $stmt->bindValue(":{$key}", null, PDO::PARAM_NULL);  
            }
            //else put the value
            else{
            $stmt->bindValue(":{$key}", $value);
            }
         }
         
        //  print_r($stmt);
        //  echo $stmt->execute();
         return $stmt->execute();
    }

    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $query = "update {$this->table} set password = :password where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function handleImageUpload($file)
    {
       $maxSize = 5 * 1024 * 1024; // Max file size 5 mb
       $tempLocation = $file['tmp_name'];
       if($file['size'] > $maxSize)
       {
        $_SESSION['error'] = "File exceeds 5MB Limit";
        return false;
       }

       $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

       $filename = uniqid('user_', true). '.' . $fileExtension;

       //creating directory if it doesn't exist
       if(!file_exists($this->uploadDir))
       {
        mkdir($this->uploadDir, 0755, true);
       }

       $filePath = $this->uploadDir. $filename;

      if(move_uploaded_file($tempLocation, $filePath))
      {
        return $filePath;
      }
      else
      {
        $_SESSION['error'] = "Failed to upload from user model";
        return false;
      }
    }
     
    public function store()
    {
        $query = "Insert into ".$this->table. " (username, email, password) values (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        //strip_tags removes the tags from the string
        //particularly used for sanitizing inputs
        $this->username = htmlspecialchars(strip_tags($this->username));       
        $this->email = htmlspecialchars(strip_tags($this->email));        
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(':username',$this->username);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':password',$hashedPassword);

        if($stmt->execute())
        {
            return true;
        }
       return false;
    }
    public function login()
    {
        $query = "Select * from $this->table where   email = :email";
        $stmt = $this->conn->prepare($query);

        $this->email = sanitize($this->email);

        $stmt->bindParam(':email', $this->email);

        $stmt->execute();
        $dbUser = $stmt->fetch(PDO::FETCH_OBJ);

        if($dbUser && password_verify($this->password, $dbUser->password))
        {
            //setting these properties from database
            //into object for using it in sessions
            $this->id = $dbUser->id;
            $this->username = $dbUser->username;
            $this->first_name = $dbUser->first_name;
            $this->last_name = $dbUser->last_name;
            return true;     
        }
        return false;
    }
}

?>