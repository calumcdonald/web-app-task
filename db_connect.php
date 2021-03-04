<?php
    function connect(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "image_db";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

        return $conn;
    }

    function close($conn){
        $conn -> close();
    }
?>