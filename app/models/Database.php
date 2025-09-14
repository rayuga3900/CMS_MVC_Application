<?php
//following singleton pattern
//where we create dynamic instance of
//database clas inside the class itself
class Database
{
    private static $instance = null;
    private $connection;
    
    public function __construct()
    {
       // $config = require base_path('config/config.php');
       
       //to get config information
        // $dbConfig = config('database');
        $host =     config('database.host');
        $dbname =   config('database.database');
        $username = config('database.username');
        $password = config('database.password');
        $port =     config('database.port');
        $charset =  config('database.charset');

        $dsn = "mysql:host={$host};
                dbname={$dbname};
                charset={$charset};
                port={$port}";

        try 
        {
            $this->connection = new PDO($dsn, $username, $password);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
                die("Database failed ". $e -> getMessage());
        }
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this -> connection;
    }
    //__clone method is used to define
    //what aspects of object can be cloned
    //or modified in cloned instance
    private function __clone(){}

    //__wakeup method is called automatically
    //during unserialization
    //unserialize means (converted back 
    // from string or bytestream into object)
    public function __wakeup(){}
}



?>