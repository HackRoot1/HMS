<?php 

include("./config.php");

if(isset($_GET['up_id'])) {

    $patient_med_id = $_GET['up_id'];

    $query = "UPDATE 
                `patients_medical_details`
            SET
                status = 'cancelled by user' 
            WHERE id = '{$patient_med_id}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ./index.php");
        exit();
    }else {
        return "Please try again";
    }

}

if(isset($_GET['dp_id'])) {

    $patient_med_id = $_GET['dp_id'];

    $query = "UPDATE 
                `patients_medical_details`
            SET
                status = 'cancelled by doctor' 
            WHERE id = '{$patient_med_id}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ./index.php");
        exit();
    }else {
        return "Please try again";
    }

}

if(isset($_GET['np_id'])) {

    $patient_med_id = $_GET['np_id'];

    $query = "UPDATE 
                `patients_medical_details`
            SET
                status = 'cancelled by nurse' 
            WHERE id = '{$patient_med_id}';";
    if(mysqli_query($conn, $query)) {
        header("Location: ./index.php");
        exit();
    }else {
        return "Please try again";
    }

}


