<?php
require "conection.php";
session_start();
$query = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id']." AND user_password = '".$_SESSION['password']."'";
$result = $conn->query($query);
if($result->num_rows == 0){
    header ('location:index.php?message="Email or Password is worng');
}
$user_id = $_SESSION['user_id'];
$query = "SELECT username,proflie_pic FROM users WHERE user_id ='" . $user_id . "'";
$result = $conn->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $profile_pic = $row['proflie_pic'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: aquamarine;
        }

        .outerbox {
            /* margin-top: 5vh;
            margin-left: 15vw; */
            height: 100vh;
            width: 100vw;
            /* transform: scale(1.2, 1); */

        }

        .innerbox1 {
            height: 10%;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .innerbox2 {
            height: 90%;
        }

        .userpic {
            position: relative;
            /* margin: 2px 5px; */
            aspect-ratio: 1/1;
            border-radius: 50%;
            margin-left: 10px;
            float: left;
        }

        .username {
            text-decoration: none;
            color: white;
            font-size: large;
        }

        .add {
            /* display: flex; */
            display: inline;
            margin-left: auto;
        }

        .info {
            margin-right: 10px;
        }

        .user {
            /* border: 2px solid red; */
            background-color: rgba(52, 58, 64, 0);
            height: 100px;
            align-items: center;
            gap: 10px;
        }

        .userpic2 {
            height: 90px;
            /* background-color: blue; */
        }

        ::-webkit-scrollbar {
            width: 10px;

        }

        ::-webkit-scrollbar-track {
            background: black;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .message1 {
            height: min-content;
            border-radius: 10px;
            border-top-right-radius: 0px;
            max-width: 60%;
            margin: 10px 10px 10px auto;
            background-color: rgb(22, 22, 134);
            /* margin-right: auto; */
        }

        .message2 {
            height: min-content;
            border-radius: 10px;
            border-top-left-radius: 0px;
            max-width: 60%;
            margin: 10px 10px;
            background-color: rgb(22, 22, 134);
        }

        .chats {
            height: fit-content;
            display: flex;
            /* justify-content: flex-end; */
            overflow: auto;
        }

        .chatting {
            display: flex;
            height: 50px;
            align-items: center;
            /* justify-content: space-around; */
            flex-direction: row;
        }

        #addmes {
            width: 100%;
            padding-left: 10px;
            height: 90%;
        }

        .chatting>img {
            padding: 1px 1px;
            height: 90%;
            background-color: rgb(129, 129, 223);
            /* display: inline;
            height: 100%;
            flex-grow: inherit; */
            /* aspect-ratio: 1/1; */
        }
    </style>
</head>

<body>
    <!-- <div class="outerbox d-flex flex-column bg-dark border border-danger"> -->
    <div class="outerbox d-flex flex-column bg-dark">
        <!-- <div class="innerbox1 border border-danger m-0 p-0"> -->
        <div class="innerbox1 m-0 p-0">
            <?php
            echo '<img src="user_img/' . $profile_pic . '" alt="TUSHAR" class="userpic h-75">
            <a href="#" class="username">' . $username . '</a>
            <a href="addfriend.php" class="username add"><i class="material-icons" style="font-size:48px;color:rgba(62, 255, 94, 0.799)">add</i></a>
            <a href="#" class="phone link-opacity-10"><i style="font-size:40px" class="fa text-white">&#xf095;</i></a>
            <a href="#" class="info link-opacity-10 m-0"><i style="font-size:40px" class="material-icons text-white">&#xe88f;</i></a>
            <a href="logout.php" class=""><i class="material-symbols-outlined" style="font-size:40px;color:rgba(242, 132, 132, 0.799)">logout</i></a>';
            ?>
        </div>
        <div class="innerbox2 d-flex flex-wrap flex-row border border-light border-opacity-25">
            <!-- <div class="d-flex flex-column border overflow-auto  border-white h-100 w-25"> -->
            <div class="d-flex flex-column overflow-auto h-100 w-25">
                <?php
                $query = "SELECT friend_id FROM friends WHERE user_id ='" . $user_id . "'";
                $result2 = $conn->query($query);
                while ($row = $result2->fetch_assoc()) {
                    $query = "SELECT username,proflie_pic FROM users WHERE user_id ='" . $row['friend_id'] . "'";
                    // if ($conn->query($query)) {
                    //     echo "succes";
                    // }
                    // else{
                    //     echo $conn->error;
                    // }
                    $result3 = $conn->query($query);
                    $friend = $result3->fetch_assoc();
                    echo '<div class="user d-flex m-0 p-0" onclick="user_select(this)">
                        <img src="user_img/' . $friend['proflie_pic'] . '" alt="profile_pic" class="userpic h-75">
                        <div class="d-flex gap-2 pt-2 flex-column">
                            <a href="#" class="text-decoration-none fs-5 text-white ">' . $friend['username'] . '</a>
                            <span class=" m-lg-0 text-info">Active Now</span>
                        </div>
                    </div>';
                }
                $conn->close();
                ?>
                <!-- <div class="user d-flex border border-danger m-0 p-0"> -->
                <div class="user d-flex m-0 p-0" onclick="todo()">
                    <img src="image/luffy.jpg" alt="TUSHAR" onclick="todo()" class="userpic h-75">
                    <div class="d-flex gap-2 pt-2 flex-column">
                        <a href="#" class="text-decoration-none fs-5 text-white ">Username</a>
                        <span class=" m-lg-0 text-info">Active Now</span>
                    </div>
                </div>
            </div>
            <!-- <div class="d-flex overflow-auto flex-column border border-white h-100 w-75"> -->
            <div class="d-flex overflow-auto flex-column h-100 w-75">

                <!-- <div class="chats d-flex overflow-auto flex-column border border-white h-100 w-100"> -->

                <div class="chats d-flex overflow-auto flex-column  h-100 w-100" id="chat_box">
                    <div class="message1 text-white d-flex align-items-center p-2">
                        <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio praesentium error autem
                            fugit.</span>
                    </div>
                </div>
                <div class="chatting">
                    <input type="search" name="addmessage" id="addmes" onclick="addchat()">
                    <img src="image/send.svg" type="button" class="text-white p-3" alt="" onclick="addchat()">
                </div>
            </div>
        </div>
    </div>


    <!-- chat insertion -->
    <!-- INSERT INTO `chats` (`chat_id`, `message`, `reserver_id`, `sender_id`, `send_time`) VALUES (NULL, 'hi how are you bro', '18', '17', current_timestamp()); -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        var search = document.getElementById('addmes');
        search.addEventListener("keypress",function(event){
            if (event.key == "Enter") {
                addchat();
            }
        })
        function reset_userselect(){
            var users = document.getElementsByClassName('user');
            // console.log(users)
            for (let index = 0; index < users.length; index++) {
                users[index].style.background = "rgba(52, 58, 64, 0)";
            }

        }
        friend_username = "undefiend";
        function user_select(user) {
            reset_userselect();
            user.style.background = "rgba(52, 58, 64, 0.5)";
            var chat_box = document.getElementById("chat_box");
            window.friend_username =  user.children[1].children[0].innerText;
            // console.log(user.children[1].children[0].innerText);
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // console.log(this.readyState);
                // console.log(this.status);
                // console.log(this.responseText);
                chat_box.innerHTML = this.responseText;
                chat_box.children[0].style.marginTop = "auto";
                chat_box.scrollTop = chat_box.scrollHeight;
            }
            xhttp.open("GET", "chatboxdata.php?friend=" + friend_username, false);
            xhttp.send();
        }
        function addchat(){
            var message = document.getElementById('addmes').value;
            document.getElementById('addmes').value = "";
            var chat_box = document.getElementById("chat_box");
            if (message == "" || message == " ") {
                return;
            }
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function (){
                console.log(this.status);
                console.log(this.readyState);
                if(this.status == 200 && this.readyState == 4){
                    var add1 = document.createElement('div');
                    add1.className = "message1 text-white d-flex align-items-center p-2";
                    add1.innerText = message;
                    chat_box.appendChild(add1);
                    chat_box.scrollTop = chat_box.scrollHeight;
                }
            }
            xhttp.open("GET","addchat.php?friend="+friend_username + "&message=" + message,true);
            xhttp.send();
        }
        function addnewmessages() {
            // console.log("running");
            var chat_box = document.getElementById("chat_box");
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function (){
                if(this.status == 200 && this.readyState == 4){
                    // console.log(this.responseText);
                    if(this.responseText != ""){
                    chat_box.innerHTML += this.responseText;
                    chat_box.scrollTop = chat_box.scrollHeight;
                    chat_box.children[0].style.marginTop = "auto";
                    }
                }
            }
            xhttp.open("GET","newchats.php?friend="+friend_username,true);
            xhttp.send();
        }
        setInterval(addnewmessages,1000);
    </script>
</body>

</html>