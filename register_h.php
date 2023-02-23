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
    <title>FOXCHAT</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="snackbar.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body onLoad = "myFunction()">

    <div class="container mt-4 text-center">
<?php 
if($message!=""){
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?=$message?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
?>
        <?php
            include "snackbar.php";
        ?>
        <div class="card mb-4" style = "display : inline-block">
            <div class="card-title mt-4">
                <strong><h4>REGISTER TO JOIN FOXCHAT</h4></strong>
            </div>
            <div class="card-body">
                <form action="register.php" method = "POST" enctype = "multipart/form-data">
                    <div class="form-group">
                        <input type="text" name = "name" id = "name" placeholder = "Full Name" class = "form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" name = "email" id = "email" placeholder = "Email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "password" id = "password" placeholder = "Password" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name = "cpassword" id = "cpassword" placeholder = "Confirm Password" class="form-control" required/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload a your picture</label>
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