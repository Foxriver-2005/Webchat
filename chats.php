<?php

   
    session_start();

    
    include('db.php');

    if(isset($_SESSION['email'])) { 
      $email=$_SESSION['email'];
          

    } else {
      header('Location:inbox.php?message=Please login first!');
     

    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCOFIELD</title>
    
    <link rel="stylesheet" href="chats.css">
    <link rel="stylesheet" href="snackbar.css">
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body onLoad = "myFunction()">

    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">WELCOME TO DEKUT FORUM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="chats.php">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout_U.php">Logout</a>
      </li>
      <?php
        $getUser = "SELECT * FROM users WHERE email = '$email'";
        $getUserStatus = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
        $getUserRow = mysqli_fetch_assoc($getUserStatus);
      ?>
      <li class = "nav-item">
        <img src="dp/<?=$getUserRow['dp']?>" alt="Profile image" width = "40" class = "dropdown"/>
      </li>
  </div>
</nav>

  
    <div class="container mt-4">
      <?php
        include "snackbar.php";
      ?>
      <div class="card">
        <div class="card-title text-center">
          <form class="form-inline mt-4" style = "display : inline-block" method = "POST" action = "search-users.php">
            <input class="form-control mr-sm-2" type="search" name = "search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        <div class="card-body mb-4">
          <?php
            $lastMessage = "SELECT DISTINCT sent_by FROM messages WHERE received_by = '$email'";
            $lastMessageStatus = mysqli_query($conn,$lastMessage) or die(mysqli_error($conn));
            if(mysqli_num_rows($lastMessageStatus) > 0) {
              while($lastMessageRow = mysqli_fetch_assoc($lastMessageStatus)) {
                $sent_by = $lastMessageRow['sent_by'];
                $getSender = "SELECT * FROM users WHERE email = '$sent_by'";
                $getSenderStatus = mysqli_query($conn,$getSender) or die(mysqli_error($conn));
                $getSenderRow = mysqli_fetch_assoc($getSenderStatus);
          ?>
          <div class="card">
            <div class="card-body">
              <h6><strong><img src = "dp/<?=$getSenderRow['dp']?>" alt = "dp" width = "40"/> <?=$lastMessageRow['sent_by'];?></strong><a href="message.php?receiver=<?=$sent_by?>" class="btn btn-outline-primary" style = "float:right">Send message</a></h6>
            </div>
          </div><br/>
          <?php
            }
          } else {
          ?>
            <div class="card-body text-center">
              <h6><strong>No conversations yet!</strong></h6>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
   
    <script src="snackbar.js"></script>
</body>
</html>