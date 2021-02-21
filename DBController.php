<?php

//DBController Script
//Create by: Tarek Alhalabi

/*
** Connect to database class
** init secure database connection with PHP PDO
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
    //connection status
    private $is_connected = FALSE;

    public function __construct(){
        $this->connect();
    }

    /*
    ** Connect to the database method
    */
    public function connect(){
        try{
            //try to connect
            $conn = new PDO($this->dbtype.":host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
            //set the error reporting type to exceptions
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //set the default data fetch mode to associative array
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->conn = $conn;
            //update the connection status to TRUE
            $this->is_connected = TRUE;
            //return TRUE
            return TRUE;

        }catch(PDOException $e){
            //report the error message
            die("Failed to connect to database: " . $e->getMessage());
        }
    }

    /*
    ** Check connection status method
    */
    public function is_connected(){
        return $this->is_connected;
    }

    /*
    ** Get the connection PDO object method
    */
    public function get_connection(){
        if($this->is_connected()) return $this->conn;
        else return FALSE;
    }

    /*
    ** Execute query method
    */
    public function execute($query, $args){
        //check if a connection is established
        if(!$this->is_connected())
            echo "Can't execute the query, no connection is established yet";

        //preapre the query
        $stmt = $this->conn->prepare($query);

        //check if the statment executed successfully
        if($stmt->execute($args)){

            $result = array();
            //return the row count
            $result["rows"] = $stmt->rowCount();
            //return the query data
            $result["data"] = $stmt->fetchAll();

            return $result;

        }else{
            //print an error message
            echo "an error happend while executing the query!";
            return;
        }
    }

}