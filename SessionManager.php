<?php

//SessionManager Script
//Create by: Tarek Alhalabi

class SessionManager{

    /*
    ** Start the session in the costructor
    */
    public function __construct(){
        if(!$this->is_started())
            session_start();
    }

    /*
    ** Destroy the current session
    */
    public function destroy(){
        if($this->is_started())
            session_destroy();
    }

    /*
    ** Start new session method
    */
    public function start(){
        if(!$this->is_started())
            session_start();
    }

    /*
    ** Check if current session is started 
    */
    public function is_started(){
        if(session_status() === PHP_SESSION_ACTIVE)
            return TRUE;
        else
            return FALSE;
    }

    /*
    ** Set new session value
    ** @param key : the key to access the session value [string]
    ** @param value : the value of the session [mixed]
    */
    public function set($key, $value){
        if($this->is_started())
            $_SESSION[$key] = $value;
        else{
            $this->start();
            $_SESSION[$key] = $value;
        }
    }

    /*
    ** Clear specific session value using the session key 
    ** @param key : the key to access the session value [string]
    */
    public function clear($key){
        if($this->is_started())
            $_SESSION[$key] = null;
    }

    /*
    ** Check if a session with specific key exists
    ** @param key : the key to access the session value [string]
    */
    public function check($key){
        if($this->is_started()){
            if(isset($_SESSION[$key]))
                return TRUE;
            else
                return FALSE;
        }
    }
}

?>