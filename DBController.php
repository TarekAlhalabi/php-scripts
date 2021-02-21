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
            //return the connection variable
            return $this->conn;

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

}



/*
** Datebase query class
** Create & execute & retrive data from database query
*/

class Query{

    //database connection string
    private $conn;
    
    function __construct(){
        //init the database connection
        $conn = new DBConnection();
        $this->conn = $conn->connect();
    }

    /*
    ** prepare and execute query method
    */
    public function execute($query, $args){
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

?>
