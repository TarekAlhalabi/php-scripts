<?php

//FileUploader Script
//Upload Files Easily consedring Security, Performance

class FileUploader{

    //allowed files extensions for each file type
    private $allowed_extensions = array(
        "image" => ["png", "jpg", "jpeg", "gif"],
        "pdf" => ["pdf"]
    );

    //maximum file size
    private $maximum_size = 200000; //2MB
    //default uploading path
    private $destination_path = "/uploads/";

    /*
    ** setMaximumSize method
    ** $size:: integer represents the file size in MB
    */
    public function setMaximumSize($size = 2){

        //convert the given $size from MB to bytes
        $this->maximum_size = $size * 100000;
        
    }
    
    /*
    ** upload file method
    ** $file:: the full $_FILES array
    ** @return true || false
    */
    public function upload($file, $RANDOMIZE = false){
        
        //extract the full file name
        $full_file_name = $file["name"];
        //extract file size in bytes
        $file_size = $file["size"];
        //extract file temp name
        $file_tmp_name = $file["tmp_name"];
        //get the file extension
        $file_ext = strtolower(pathinfo($full_file_name, PATHINFO_EXTENSION));

        //check the file extension
        if(!in_array($file_ext, $this->allowed_extensions["image"])) return false;

        //check file size
        if($file_size > $this->maximum_size) return false;

        //check for randomize parameter
        if($RANDOMIZE){
            $r = rand(100000, 900000);
            $full_file_name = $r.$full_file_name;
        }

        //upload the file
        if(move_uploaded_file($file["tmp_name"], $this->destination_path.$full_file_name)) return true;
        else return false;

    }
}

?>