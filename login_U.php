<?php
    
    
    session_start();

    
    include('db.php');


    $email = "";
    $password = "";
    $salt=uniqid();

    if(isset($_POST['email'])) {
        $email=$_POST['email'];
        
    }

    if(isset($_POST['password'])) {
        $password=$_POST['password'];
      
    }

  
    if($email != "" && $password != "") {
        $checkUser="SELECT * FROM users WHERE email='$email'";
        $checkUserStatus = mysqli_query($conn,$checkUser) or die(mysqli_error($conn));

        if(mysqli_num_rows($checkUserStatus) > 0) { 
            $getSalt="SELECT * FROM users WHERE email='$email'";
            $getSaltStatus=mysqli_query($conn,$getSalt) or die (mysqli_error($conn));
            $getSaltRow=mysqli_fetch_assoc($getSaltStatus);

            $salt=$getSaltRow['salt'];
            $dbPassword=$getSaltRow['password'];
            $ePassword=md5(md5($password).$salt);
            if($ePassword==$dbPassword){
                $_SESSION['email']=$email;   
           header('Location:index.php?message=you have logged in!');
              }


         else {
           
            header('Location:inbox.php? message=Incorrect Password!');
        } }

         else{

        header('Location:inbox.php? message=User not found,please register first');

         }
        }
        else{
            header('Location:inbox.php?message=please fill all the fields!');
        }

        
?>