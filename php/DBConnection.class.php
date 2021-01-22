<?php

//DB Connect Class
//Create by: Tarek Alhalabi
//Version: 1.0.0
/*
    Ready to use and implement php class to establish secure connection
    with the mysql database
*/

class DBConnection{

    //database type
    private $dbtype = "mysql";
    //domain or host
    private $host = "localhost";
    //database name
    private $dbname = "test";
    //database username 
    private $username = "root";
    //database user password
    private $password = "";
    private $conn;

    public function connect(){
        try{
            //try to connect
            $conn = new PDO($this->db_type.":host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
            //set the error reporting type to exceptions
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //set the default data fetch mode to associative array
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->conn = $conn;
            //return the connection variable
            return $this->conn;

        }catch(PDOException $e){
            //report the error message
            die("Failed to connect to database: " . $e->getMessage());
        }
    }

}

?>
