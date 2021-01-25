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
    private $maximum_size = 1; //MB
    //default uploading path
    private $destination_path = "/uploads/";
    

}

?>