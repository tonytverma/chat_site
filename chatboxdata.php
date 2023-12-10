<?php
require "conection.php";
session_start();
// echo " somting";
$user_id = $_SESSION['user_id'];
$query = "SELECT user_id FROM users WHERE username = '".$_REQUEST['friend']."'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$friend_id = $row['user_id'];
$query = "SELECT message,sender_id FROM `chats` WHERE (sender_id = ".$user_id." AND reserver_id = ".$friend_id.") OR (sender_id = ".$friend_id." AND reserver_id = ".$user_id.")";
$result2 = $conn->query($query);
if ($result2->num_rows == 0) {
    echo "something";
}
while ($row = $result2->fetch_assoc()) {
    if ($row['sender_id'] == $user_id) {
        echo '<div class="message1 text-white d-flex align-items-center p-2">
                            <span>' . $row['message'] . '</span>
                    </div>';
    } else {
        echo '<div class="message2 text-white d-flex align-items-center p-2">
                            <span>' . $row['message'] . '</span>
                    </div>';
    }
}
$conn->close();
?>
