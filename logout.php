<?php
    require "conection.php";
    session_start();
    $query = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id']." AND user_password = '".$_SESSION['password']."'";
    $result = $conn->query($query);
    if($result->num_rows == 0){
        header ('location:index.php?message="Email or Password is worng"');
    }
    session_destroy();
    header('location:index.php?message="you have succesfully log out');
?>