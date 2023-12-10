<?php
    require "conection.php";
    session_start();
    echo "username is " .$_REQUEST['friend'];
    $user_id = $_SESSION['user_id'];
    $query = "SELECT user_id FROM users WHERE username = '".$_REQUEST['friend']."'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $friend_id = $row['user_id'];
    echo "some " . $friend_id . "is its id";
    $query = "INSERT INTO `chats` (`message`, `reserver_id`, `sender_id`, `send_time`) VALUES ('".$_REQUEST['message']."',".$friend_id.",".$user_id.", current_timestamp())";
    // if ($conn->query($query)) {
    //     echo "somthing";
    // }
    // else{
    //     echo $conn->error ."<br>";
    //     echo $query;
    // }
    $result2 = $conn->query($query);
    $conn->close();
?>