<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'Ian');
    define('DB_PASS', 'password');
    define('DB_NAME', 'exercise_app');

    try {
        //code...

        //create connection 
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($conn->connect_error){
            throw new Exception('Connection failed: '.$conn->connect_error);
        }
   
    } catch (Exception $e) {
        //throw $th;
        echo 'Error: '. $e->getMessage();
    }
