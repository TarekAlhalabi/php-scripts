<?php

//DB Connect Class
//Create by: Tarek Alhalabi
//Version: 1.0.0
/*
    Ready to use and implement php class to establish secure connection
    with the mysql database
*/

class db{
    
    private $host = "localhost";
    private $dbname = "test";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect(){
        try{
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn = $conn;

            return $this->conn;

        }catch(PDOException $e){
            die("Failed to connect to database: " . $e->getMessage());
        }
    }

}

?>
