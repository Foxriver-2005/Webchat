<?php

    
    session_start();

  
    include('db.php');

   
    $name = "";
    $email = "";
    $password = "";
    $cpassword = "";
    $salt = uniqid();

   
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if(isset($_POST['password'])) {
        $cpassword = $_POST['password'];
    }

    $newPassword = md5(md5($password).$salt);

  
    $target_dir = "dp/";
    $target_file = $target_dir . basename($_FILES["dp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dp"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File is not an image.";
        $uploadOk = 0;
        }
    }

    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

  
    if ($_FILES["dp"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
  
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }


    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
   
    } else {
        if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["dp"]["name"]). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }

    if($name != "" && $email != "" && $password != "" && $cpassword != "") { 
        
        $checkUser = "SELECT * FROM users WHERE email = '$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { 

            header('Location:inbox.php?message=You have already registered!');

        } else {

            if($password == $cpassword) { 
            
                $image = basename($_FILES["dp"]["name"]);
                $insertUser = "INSERT INTO users(name,email,password,dp,salt) VALUES('$name','$email','$newPassword','$image','$salt')";
                $insertUserStatus = mysqli_query($conn,$insertUser) or die(mysqli_error($conn));
    
                if($insertUserStatus) { 
      
                    header('Location: inbox.php?message=You have registered successfully! Please Login');
    
                }  else { 
    
                    header('Location: register_U.php?message=Unable to register!');
    
                }
    
            } else { 
    
                header('Location: register_U.php?message=Password fields do not match!');
    
            }

        }


    } else { 

        header('Location:register_U.php?message=Please fill the fields properly!');  

    }
?>