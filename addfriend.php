<?php
    require "conection.php";
    $mess = FALSE;
    session_start();
    $query = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id']." AND user_password = '".$_SESSION['password']."'";
    $result = $conn->query($query);
    if($result->num_rows == 0){
        header ('location:index.php?message="Email or Password is worng"');
    }
    if (!isset($_SESSION['user_id'])) {
        $message = "Please Login First";
        die (header ("location:index.php"));
    }
    else{
        $user_id = $_SESSION['user_id'];
    }
    $query = "SELECT user_id,username,proflie_pic FROM users";
    $result = $conn->query($query);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // echo "<h1>something</h1>";
        $friend_id = $_POST['friend_id'];
        $query = "INSERT INTO friends(`user_id`, `friend_id`) VALUES ('".$user_id."','".$friend_id."')";
        $result2 = $conn->query($query);
        if($result2){
            $mess = TRUE;
        }
        else{
            echo $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
           padding: 0px;
           margin: 0px; 
        }
        .outer_div {
            background-color: rgba(52, 58, 64, 0.7);
            z-index: -1;;
            display: flex;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            width: 100vw;
            margin: 0px;
            padding: 0px;
            /* background-color: aqua; */
        }
        .inner_div1{
            background-color: rgba(52, 58, 64, 0.8);
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            height: 50px;
            width: 100vw;
            /* border: 1px solid red; */
        }
        .inner_div2{
            background: rgba(0, 0, 0, 0.7);
            width: 80vw;
            gap: 50px;
            display: flex;
            flex-direction: row;
            /* align-items: center; */
            justify-content: center;
            /* border: 2px solid red; */
            flex-grow: 1;
            flex-wrap: wrap;
            overflow: auto;
            /* border: 1px solid red; */
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
        .items{
            background: rgba(52, 58, 64, 1);
            margin: 20px;
            height: 300px;
            width: 200px;
            /* border: 1px solid red; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .items>img{
            max-width: 200px;
            max-height: 300px;
        }
        .alerts{
            z-index: 10;
            margin-top: 10vh;
            width: 40vw;
            margin-left: 30vw;
        }
    </style>
</head>
<body>
    <?php
        if ($mess) {
            // echo $_GET['message'];
             echo  '<div class="alerts position-fixed alert alert-info alert-dismissible fade show" role="alert">
            <strong>Friend is Added </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <div class="outer_div container-fluid text-center align-self-cente z-0 text-white">
        <div class="inner_div1 m-0 p-0">
            <input class="search" type="search" name="search" id="search">
            <button class="btn btn-info ">search</button>
        </div>
        <div class="inner_div2">
            <?php
                while($row = $result->fetch_assoc()){ 
                    
                    $query = "SELECT * FROM friends WHERE user_id ='".$user_id."' AND friend_id ='".$row['user_id']."'";
                    $result2 = $conn->query($query);
                    if($row['user_id'] != $user_id && !($result2->num_rows > 0)){
                    echo '<form class="items " method="post" action="addfriend.php">
                    <input type="text" value="'.$row['user_id'].'" id="friend_id" name="friend_id" class="d-none" readonly>
                    <img src="user_img/'.$row['proflie_pic'].'" alt="Profile Pic" class="h-75 w-auto pt-1">
                    <span class="h-25">'.$row['username'].'</span>
                    <button class="btn btn-danger mb-2 w-50" type="submit">Add_Frined</button>
                </form>';
                    }
                }
                $conn->close();
            ?>
            <!-- <form class="items " method="post" action="addfriend.php">
                <input type="text" value="friend_id" id="friend_id" name="friend_id" class="d-none" readonly>
                <img src="user_img/tanishq.jpg" alt="Profile Pic" class="h-75 w-auto pt-1">
                <span class="h-25">tanishq</span>
                <button class="btn btn-danger mb-2 w-50" type="submit">Add_Frined</button>
            </form> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>