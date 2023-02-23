<?php

  
    session_start();

  
    include('db.php');
    error_reporting(0);

   
    $message = $_GET['message'];

    
     if(isset($_SESSION['email'])) { 

        header('Location:chats.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEKUT FORUM</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="snackbar.css">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body onLoad = "myFunction()">

    <div class="container mt-4 text-center">
        <?php
            include "snackbar.php";
        ?>
        <div class="card mb-4" style = "display : inline-block">
            <div class="card-title mt-4">
                <strong><h4>Register</h4></strong>
            </div>
            <div class="card-body">
                <form action="register1.php" method = "POST" enctype = "multipart/form-data">
                    <div class="form-group">
                        <input type="text" name = "name" id = "name" placeholder = "Full Name" class = "form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" name = "email" id = "email" placeholder = "Email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "password" id = "password" placeholder = "Password" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "cpassword" id = "cpassword" placeholder = "Confirm Password" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload your picture</label>
                        <input type="file" class="form-control-file" id="dp" name = "dp" required/>
                    </div>
                    <button type = "submit" class = "btn btn-outline-primary">Register</button>
                    <p class = "text-muted mt-2">Already have an account? <a href="index.php">Login Here!</a></p>
                </form>
            </div>
        </div>
    </div>

   
    <script src="snackbar.js"></script>
</body>
</html>

