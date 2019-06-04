<?php
    $host = 'localhost';
    $username = 'root';
    $password = "";
    $server = "library_space";

    $connection = mysqli_connect($host, $username, $password, $server);
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'library_space');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }