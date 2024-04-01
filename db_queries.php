<?php 

    $conn = mysqli_connect("localhost", "root", "", "hms_db2") or die("Connection failed");

// =====================================================================================================
// ============================= function to get logged user data using it's email =====================
    function get_all_user_data($conn, $email){
        $query = "SELECT * FROM `users_data` WHERE email = '{$email}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            return ("Query Failed");
        }
    }

// ========================================= end ========================================================








    
// ============================================================================================================
// ================================= Fetch Dashboard's count of total, completed, pending ============================
    // fetch total appointments of a patient
    function patient_total_appointment_count($conn, $role_column, $id) {
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$id}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
    // fetch total appointments of a patient
    function patient_complete_appointment_count($conn, $role_column, $id) {
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$id}' AND status = 'completed'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
    // fetch total appointments of a patient
    function patient_pending_appointment_count($conn, $role_column, $id) {
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$id}' AND status = 'pending'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
// ====================================== end ================================================================







// ===========================================================================================================
// ============================== Other roles can fetch patient's data using patient id ======================
// ================== i.e. roles - nurse, receptionist, doctor and admin =====================================
// ===================== This function can get any role's data using just it's id ============================

    // function to get user data using it's patient_id 
    function get_user_data($conn, $id){
        $query = "SELECT * FROM `users_data` WHERE id = '{$id}'";
        if(mysqli_query($conn, $query)){
            $data = mysqli_query($conn, $query);
            return mysqli_fetch_array($data);
        } else{
            echo ("Query Failed");
        }
    }


    function get_medical_details_of_all_patients($conn) {
        $query = "SELECT * FROM `patients_medical_details`";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }
// ======================================================== end ===============================================




// ============================================================================================================
// ==================================== Patient and Nurse =====================================================


    // =================================== Fetching patient's medical details==================================
    // =================================== using column role and id ===========================================


    // Fetching pending data
    function get_patients_medical_details($conn, $role_column, $role_id){
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$role_id}' AND status = 'pending' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }

    // Fetching history data
    function get_patients_medical_details_history($conn, $role_column, $role_id){
        
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d");        
        // get current time
        $time = date("h:i:s");
        
        $query = "SELECT * FROM `patients_medical_details` WHERE $role_column = '{$role_id}' AND status <> 'pending' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }


// ============================================= end ==========================================================

















// ================================================================================================================
// ================================================================================================================
// ============================================ Receptionist ======================================================


    // fetch total appointments of a patient  i.e. counts
    function all_count_receptionist($conn) {
        $query = "SELECT * FROM `patients_medical_details`";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
    // fetch total appointments of a patient
    function all_completed_receptionist($conn) {
        $query = "SELECT * FROM `patients_medical_details` WHERE status = 'completed'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }
    
    // fetch total appointments of a patient
    function all_pending_receptionist($conn) {
        $query = "SELECT * FROM `patients_medical_details` WHERE status = 'pending'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        } else{
            echo ("Query Failed");
        }
    }

    // fetch newly added appointments of patient's  i.e. index page.
    function get_all_new_appointments($conn){
        $date = date("Y-m-d");
        $null_date = "0000-00-00";
        
        $query = "SELECT * FROM `patients_medical_details` WHERE status = 'pending' AND (appointment_date = '0000-00-00') ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }

    // fetch newly added appointments of patient's  i.e. index page.
    function get_all_new_and_pending_appointments($conn){

        $query = "SELECT * FROM `patients_medical_details` WHERE status = 'pending' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }


    
    // Fetching history data
    function get_all_old_appointments($conn){
        
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d");        
        // get current time
        $time = date("h:i:s");
        
        $query = "SELECT * FROM `patients_medical_details` WHERE status <> 'pending' ORDER BY appointment_date, appointment_time DESC";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }

// =================================================== end ========================================================















// ==================================================================================================================
// ================================================ Doctor ==========================================================


    // Fetch all patient's from database
    function get_list_of($conn, $role) {
        $query = "SELECT * FROM `users_data` WHERE role = '{$role}'";
        if(mysqli_query($conn, $query)){
            return mysqli_query($conn, $query);
        }else{
            echo "Query Failed";
        }
    }

// ================================================= End ============================================================

