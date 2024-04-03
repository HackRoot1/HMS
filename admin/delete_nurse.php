<?php 

include("../config.php");

if(isset($_GET['nurse_id'])) {
    $query = "DELETE FROM users_data WHERE id = '{$_GET['nurse_id']}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ../index.php");
        exit();
    }else {
        echo "Query Failed";
    }
}


if(isset($_GET['receptionist_id'])) {
    $query = "DELETE FROM users_data WHERE id = '{$_GET['receptionist_id']}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ../index.php");
        exit();
    }else {
        echo "Query Failed";
    }
}



if(isset($_GET['doctor_id'])) {
    $query = "DELETE FROM users_data WHERE id = '{$_GET['doctor_id']}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ../index.php");
        exit();
    }else {
        echo "Query Failed";
    }
}


