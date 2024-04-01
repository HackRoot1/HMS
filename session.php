<?php 

    session_start();
    // ======================= if user's session is not active
    if(!$_SESSION['user']){
        header("Location:" . $path . "login.php");
    }
    // =========================== end 

    // ======================== if user logout
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: " . $path . "login.php");
        exit();
    }
    // ============================ end 
