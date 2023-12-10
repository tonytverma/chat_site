<?php
    require "conection.php";
    $check = FALSE;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $query = "SELECT user_id FROM users WHERE Email = '".$_POST['Email1']."' AND user_password = '".$_POST['Password1']."'";
        $result = $conn->query($query);
        // if($conn->query($query) == TRUE){
        //     echo "something";
        // }
        // else{
        //     echo $conn->error;
        // }
        if($result){
            echo "something";
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['password'] = $_POST['Password1'];
            header ('location:chat.php');
        }
        else {
            echo "nothing";
            $check = TRUE;
        }

    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            size: initial;
            margin: 0px 0px;
            padding: 0px 0px;
            /* background-image: url(image/line.jpeg); */
            /* background-repeat: no-repeat;
            background-size: cover; */

        }
        
        #toggle1 {
            display: none;
        }

        #toggle2 {
            display: inline;
        }

        #toggle3 {
            display: inline;
        }

        #toggle4 {
            display: none;
        }

        .outer_div {
            margin-top: 20vh;
            height: 60vh;
            width: 60vw;
            /* background-color: aqua; */
        }

        /* .inner_div>form{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    } */
        .color_change {
            /* position: sticky; */
            /* margin-top: vh; */
            margin-left: 20vw;
            z-index: 1;
            padding: 0px;
            background-color: #747E7E;
            height: 60vh;
            width: 30vw;
        }
        .alerts{
            margin-bottom: 20vh;
        }
    </style>
</head>

<body>
    <?php
        if (isset($_GET['message'])) {
            echo  '<div class="alerts position-absolute alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Made Mistake </strong>'.$_GET['message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }  
    ?>
    <div class="color_change position-absolute z-n1 rounded-3"></div>
    <div class="outer_div container-fluid text-center align-self-cente text-white rounded-3">
        <div class="inner_div row h-100 w-100 m-0 p-0">
            <div id="toggle1" class="inner_div col-6 m-0 w-50 h-100 align-self-center pt-5">
                <p class="mt-3 mb-2 text-body-emphasis fs-2">Already have account then</p>
                <button type="button" onclick="clickmetoo()" class="btn btn-primary h-10 w-25 border rounded-3 mt-4">Sign
                    in</button>
            </div>
            <div id="toggle2" class="inner_div col-6 m-0 w-50 h-100 align-self-center  pt-5">
                <form ction="index.php" method="post" class="mt-5 z-3">
                    <h1 class="h3 h-50 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating mt-2">
                        <input type="email" class="form-control" id="Email1" name="Email1" placeholder="name@example.com">
                        <label for="Email1" class="text-black">Email address</label>
                    </div>
                    <div class="form-floating mt-2 pb-3">
                        <input type="password" class="form-control" id="PAssword1" name="Password1" placeholder="Password">
                        <label for="PAssword1" class="text-black">Password</label>
                    </div>
                    <button class="btn btn-primary w-50 py-2" type="submit">Sign in</button>
                    <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> -->
                </form>
            </div>
            <div id="toggle3" class="inner_div col-6 m-0 w-50 h-100 align-self-center  pt-5">
                <p class="mt-3 mb-2 text-body-emphasis fs-2">Don't Have Account Then</p>
                <button type="button" onclick="clickme()" class="btn btn-primary h-10 w-25 border rounded-3 mt-4">Sign
                    In</button>
            </div>
            <div id="toggle4" class="inner_div col-6 m-0 w-50 h-100 bg-transparent ">
                <form action="create_account.php" method="post" class="mt-5">
                    <h1 class="h3 h-50 mb-3 fw-normal">Please sign up</h1>

                    <div class="form-floating mt-2">
                        <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com">
                        <label for="Email" class="text-black">Email address</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                        <label for="Password" class="text-black">Password</label>
                    </div>
                    <div class="form-floating mt-2 pb-3">
                        <input type="password" class="form-control" id="ConformPassword" name="ConformPassword" placeholder="ConformPassword">
                        <label for="ConformPassword" class="text-black">Conform Password</label>
                    </div>
                    <button class="btn btn-primary w-50 py-2" type="submit">Sign up</button>
                    <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> -->
                </form> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        var toggle1 = document.getElementById("toggle1");
        var toggle2 = document.getElementById("toggle2");
        var toggle3 = document.getElementById("toggle3");
        var toggle4 = document.getElementById("toggle4");
        function clickme() {
            console.log(toggle1, toggle2);
            id = null;
            let element = document.getElementsByClassName("color_change");
            console.log(element[0].style.width);
            let change_value = (innerWidth / 100) * 30;
            console.log(change_value);
            let pos = 0;
            clearInterval(id);
            id = setInterval(frame, 5);
            function frame() {
                if (pos >= change_value) {
                    clearInterval(id);
                    toggle1.style.display = "inline";
                    toggle2.style.display = "none";
                    toggle3.style.display = "none";
                    toggle4.style.display = "inline";
                }
                else {
                    pos = pos + 2;
                    element[0].style.left = pos + "px";
                }
            }

        }
        function clickmetoo() {
            id2 = null;
            let element = document.getElementsByClassName("color_change");
            console.log(element[0].style.width);
            let change_value = (innerWidth / 100) * 30;
            console.log(change_value);
            let pos = change_value;
            clearInterval(id2);
            id = setInterval(frame, 5);
            function frame() {
                if (pos <= 0) {
                    clearInterval(id2);
                    toggle2.style.display = "inline";
                    toggle1.style.display = "none";
                    toggle4.style.display = "none";
                    toggle3.style.display = "inline";
                }
                else {
                    pos = pos - 2;
                    element[0].style.left = pos + "px";
                }
            }
        }
    </script>
</body>

</html>