<?php
    require "conection.php";
    if(isset($_POST['name'])){
        require 'check.php';
        session_start();
        $some = TRUE;

        $query = "SELECT * FROM TABLE `users` WHERE username='".$_POST['username']."',";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $_message7 = "Username is Already taken";
        die (header('location:create_account.php?message=' .$_message7));
        }
        $query = "INSERT INTO `users` (`username`, `name`, `proflie_pic`, `user_password`,`Email`) VALUES ('".$_POST['username']."','".$_POST['name']."','". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]))."','".$_SESSION['Password']."','".$_SESSION['Email']."')";
        if($conn->query($query) == TRUE){
            $user_id = $conn->query("SELECT user_id FROM TABLE `users` WHERE username='".$_POST['username']."',");
            if(!$user_id){
                // echo "something";
            }
            $_SESSION["user_id"] = $user_id;
            header ('location:chat.php');
            
        }
        else{
            echo $conn->error;
        }
    }
    elseif(isset($_POST['Password'])) {
        // echo "something";
        session_start();
        $_SESSION["Email"] = $_POST["Email"];
        if ($_POST["Password"] != $_POST["ConformPassword"]) {
            $message1 = "Password Is not matched";
            die (header("Location: index.php?message=".$message1));
        }
        else if(strlen($_POST["Password"]) <8){
            $message2 = "Password Is too short";
            die (header("Location: index.php?message=".$message2));
        }
        $_SESSION["Password"] = $_POST["Password"];
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: aquamarine;
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .outerbox {
            height: 80vh;
            width: 50vw;
            display: flex;
            transform: scale(1.2, 1);
            background-color: darkolivegreen;
            align-items: center;
            justify-content: center;
        }
        .alerts{
            position: sticky;
            margin-top: 20px;
            top: 0px;
        }
    </style>
</head>

<body>
    <?php
        if (isset($_GET['message'])) {
            // echo $_GET['message'];
             echo  '<div class="alerts position-fixed alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Made Mistake </strong>'.$_GET['message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <form method="post" action="create_account.php" enctype="multipart/form-data" class="form-floating mt-5">
        <h1 class="h3 h-50 mb-3 fw-normal">add details</h1>

        <div class="form-floating mt-2">
            <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
            <label for="name" class="text-black">name</label>
        </div>
        <div class="form-floating mt-2">
            <input type="text" class="form-control" id="username" name ="username" placeholder="name@example.com">
            <label for="username" class="text-black">username</label>
        </div>
        <div class="form-floating mt-2">
            <input type="date" class="form-control" id="date" name="date" placeholder="date">
            <label for="date" class="text-black">DOB</label>
        </div>
        <div class="form-floating mt-2">
            Add profile image 
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <button class="btn btn-primary w-50 m-2 py-2" type="submit">Sign up</button>
        <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> -->
    </form> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>