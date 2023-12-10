<?php
    require "conection.php";
    session_start();
    $user_id = $_SESSION['user_id'];
    if ($_REQUEST['friend'] == "undefiend") {
        die;
    }
    $query = "SELECT user_id FROM users WHERE username = '" . $_REQUEST['friend'] . "'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $friend_id = $row['user_id'];
    // echo "some " . $friend_id . "is its id";
    $query = "SELECT message,chat_id FROM `chats` WHERE seen = 0 AND reserver_id = " . $user_id . " AND sender_id = ".$friend_id."";
    $result2 = $conn->query($query);
    $totel_number = $result2->num_rows;
    $max_value = 0;
    if ($result2->num_rows == 0) {
        die;
    }
    while ($row = $result2->fetch_assoc()) {
        $max_value = $row['chat_id'];
        echo '<div class="message2 text-white d-flex align-items-center p-2">
                            <span>' . $row['message'] . '</span>
                    </div>';  
    }
    $start = $max_value-$totel_number;
    $query = "UPDATE `chats` SET seen = 1 WHERE chat_id BETWEEN ".$start." AND ".$max_value."";
    $conn->query($query);
?>
