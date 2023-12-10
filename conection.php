<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "whatsapp";
    $port = 8111;
    $conn = new mysqli($servername,$username,$password,$database,$port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    //   echo "Connected successfully";
?>