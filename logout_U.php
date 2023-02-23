<?php

    session_start();
    unset($_SESSION["email"]);
    session_destroy();
    header("Location:welcome.php?message=You have been successfully logged out!");

?>