<?php

    $servername = "localhost";
    $username = "Admin";
    $pasword = "Admin123";
    $datebase = "quantox";

    global $conn;
    $conn = new Mysqli($servername, $username, $pasword, $datebase);

    if ($conn->connect_error) {
        die("Connection failed! Reason: " . $conn->connect_error);
    }

    $conn->set_charset("UTF8");
    
?>