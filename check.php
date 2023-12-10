<?php
    $target_dir = "user_img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $_message1 = "File is not an image.";
        die (header('location:create_account.php?message='.$_message1));
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $_message2 = "Sorry, file already exists.";
        die (header('location:create_account.php?message=' .$_message2));
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $_message3 = "Sorry, your file is too large.";
        die (header('location:create_account.php?message='.$_message3));
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_message4 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        die (header('location:create_account.php?message='.$_message4));
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $_message5 = "Sorry, your file was not uploaded.";
        die (header('location:create_account.php?message='.$_message5));
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        $_message6 = "Sorry, there was an error uploading your file.";
        die (header('location:create_account.php?message='.$_message6));
    }
    }
?>