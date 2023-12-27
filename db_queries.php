<?php 

    $conn = mysqli_connect("localhost", "root", "", "hms_db2") or die("Connection failed");


    // function to get logged user data using it's email 
    function get_all_user_data($conn, $email){
        $query = "SELECT * FROM `users_data` WHERE email = '{$email}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }



    // function to get user data using it's patient_id 
    function get_user_data($conn, $id){
        $query = "SELECT * FROM `users_data` WHERE id = '{$id}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
    

    // fetch all patient's data from database 
    function get_all_patients_data($conn){
        $query = "SELECT * FROM `patients_medical_details` ORDER BY appointment_date";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
   
    

    // fetch all patient's data from database 
    function get_all_patients_data_not_history($conn){
        $date = date("Y-m-d");        
        $null_date = "0000-00-00";
        $query = "SELECT * FROM `patients_medical_details` WHERE (appointment_date > '{$date}' OR appointment_date = '{$null_date}') ORDER BY appointment_date";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    
    
    
    // fetch all patient's data from database 
    function get_only_logged_patient_data($conn, $id){
        $date = date("Y-m-d");        
        $null_date = "0000-00-00";
        $query = "SELECT * FROM `patients_medical_details` WHERE patient_id = {$id} AND (appointment_date > '{$date}' OR appointment_date = '{$null_date}') ORDER BY appointment_date, appointment_time";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    

    
    // fetch all patient's data from database based on status
    function get_only_logged_patient_data_on_status($conn, $id){
        $date = date("Y-m-d");        
        $null_date = "0000-00-00";
        $query = "SELECT status,COUNT(status) as status_count FROM `patients_medical_details` WHERE patient_id = '{$id}' GROUP BY status";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    


    
    // fetch all patient's data from database 
    function get_only_logged_patient_data_history($conn, $id){
        $date = date("Y-m-d");        
        $null_date = "0000-00-00";
        $query = "SELECT * FROM `patients_medical_details` WHERE patient_id = {$id} AND (appointment_date < '{$date}' AND NOT appointment_date = '{$null_date}') ORDER BY appointment_date";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    
    
    
    
    // fetch all data based on role from database 
    function get_all_roles_data($conn, $role){
        $query = "SELECT * FROM `users_data` WHERE role = '{$role}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    



    // fetch all patient's data based on role from database 
    function get_all_patient_data_on_roles($conn, $role_column, $role_id){
        $date = date("Y-m-d");
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$role_id}' AND appointment_date > '{$date}' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    
    
    // fetch all patient's data based on role but data is passed data / the data is historical data from database 
    function get_all_patient_data_on_roles_history($conn, $role_column, $role_id){
        $date = date("Y-m-d");
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$role_id}' AND appointment_date < '{$date}' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
    




?>