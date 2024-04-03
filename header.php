<?php 

    include($path . "config.php");
    include($path ."db_queries.php");
    include($path ."session.php");

    // getting all user data - the user is one who is logged in
    $query = get_all_user_data($conn, $_SESSION['user']);
    $fetch_user_data = mysqli_fetch_assoc($query);


    // ======================================================== Automatically update status of patient ======================================
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");        
    // get current time
    $time = date("h:i:s");

    $date_modify = get_medical_details_of_all_patients($conn);
    while($date_data = mysqli_fetch_array($date_modify)) {

        if($date_data['appointment_date'] <= $date) {
            if($date_data['appointment_date'] == $date && $date_data['appointment_time'] <= $time) {
                $update_query = "UPDATE `patients_medical_details` SET status = 'completed' WHERE appointment_date < '{$date}' AND appointment_date <> '0000-00-00'";
                mysqli_query($conn, $update_query);
            }
        }
    }

    // ======================================================================= end ===============================================




    if($fetch_user_data['role'] == 'patient'){
        
        $patient_data = get_patients_medical_details($conn, 'patient_id', $fetch_user_data['id']);
        $patient_data_history = get_patients_medical_details_history($conn, 'patient_id', $fetch_user_data['id']);

        // =============================== only for dashboard count....
        $patient_total_appointment_count = patient_total_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  
        $patient_complete_appointment_count = patient_complete_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  
        $patient_pending_appointment_count = patient_pending_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  

        $patient_booked_appointment_count = patient_booked_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  
        $patient_cancelled_by_u_appointment_count = patient_cancelled_by_u_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  
        $patient_cancelled_by_d_appointment_count = patient_cancelled_by_d_appointment_count($conn, 'patient_id', $fetch_user_data['id']);  
 

    }else if($fetch_user_data['role'] == 'nurse'){
        
        $patient_data = get_patients_medical_details($conn, 'nurse_id', $fetch_user_data['id']);
        $patient_data_history = get_patients_medical_details_history($conn, 'nurse_id', $fetch_user_data['id']);

        // =============================== only for dashboard count....
        $patient_total_appointment_count = patient_total_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  
        $patient_complete_appointment_count = patient_complete_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  
        $patient_pending_appointment_count = patient_pending_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  

        $patient_booked_appointment_count = patient_booked_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  
        $patient_cancelled_by_u_appointment_count = patient_cancelled_by_u_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  
        $patient_cancelled_by_d_appointment_count = patient_cancelled_by_d_appointment_count($conn, 'nurse_id', $fetch_user_data['id']);  
 
    }else if($fetch_user_data['role'] == 'receptionist'){

        $patient_data = get_all_new_appointments($conn);
        $patient_data_history = get_all_old_appointments($conn);
        $patient_data_new_old = get_all_new_and_pending_appointments($conn);

        // =============================== only for dashboard count....
        $patient_total_appointment_count = all_count_receptionist($conn);  
        $patient_complete_appointment_count = all_completed_receptionist($conn);  
        $patient_pending_appointment_count = all_pending_receptionist($conn);  

        $patient_booked_appointment_count = all_booked_appointment_count($conn);  
        $patient_cancelled_by_u_appointment_count = all_cancelled_by_u_appointment_count($conn);  
        $patient_cancelled_by_d_appointment_count = all_cancelled_by_d_appointment_count($conn);  
 
    }else if($fetch_user_data['role'] == 'doctor'){

        $patient_data = get_patients_medical_details($conn, 'doctor_id', $fetch_user_data['id']);
        $list_of_patients = get_list_of($conn, 'patient');
        $list_of_nurses = get_list_of($conn, 'nurse');
        $list_of_receptionists = get_list_of($conn, 'receptionist');
        $all_patients_list = get_medical_details_of_all_patients($conn);
        $patient_data_history = get_patients_medical_details_history($conn, 'doctor_id', $fetch_user_data['id']);


        // =============================== only for dashboard count....
        $patient_total_appointment_count = patient_total_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
        $patient_complete_appointment_count = patient_complete_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
        $patient_pending_appointment_count = patient_pending_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
        
        $patient_booked_appointment_count = patient_booked_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
        $patient_cancelled_by_u_appointment_count = patient_cancelled_by_u_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
        $patient_cancelled_by_d_appointment_count = patient_cancelled_by_d_appointment_count($conn, 'doctor_id', $fetch_user_data['id']);  
 
    }else if($fetch_user_data['role'] == 'admin'){

        // get_all_patients_data($conn);
        $patient_data = get_all_new_and_pending_appointments($conn);

        $list_of_patients = get_list_of($conn, 'patient');
        $list_of_nurses = get_list_of($conn, 'nurse');
        $list_of_receptionists = get_list_of($conn, 'receptionist');
        $list_of_doctors = get_list_of($conn, 'doctor');
        
        $all_patients_list = get_medical_details_of_all_patients($conn);
        $patient_data_history = get_all_old_appointments($conn);
        $patient_data_new_old = get_all_new_and_pending_appointments($conn);


        // =============================== only for dashboard count....
        $patient_total_appointment_count = all_count_receptionist($conn);  
        $patient_complete_appointment_count = all_completed_receptionist($conn);  
        $patient_pending_appointment_count = all_pending_receptionist($conn);  

        $patient_booked_appointment_count = all_booked_appointment_count($conn);  
        $patient_cancelled_by_u_appointment_count = all_cancelled_by_u_appointment_count($conn);  
        $patient_cancelled_by_d_appointment_count = all_cancelled_by_d_appointment_count($conn);  
 
    }

?>

<!-- Header file's common part -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="<?= $path ?>assets/css/style.css">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="<?= $path ?>assets/css/registration.css">
    
    <!-- ===== Iconscout CSS ====== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class = "logo-image">
                <img src="<?= $path ?>assets/images/logo.png" alt="">
            </div>

            <span class="logo_name">HMS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <?php 
                
                    if($fetch_user_data['role'] == "patient"){
                        foreach($patient as $key => $value) {
                ?>
                    <li>
                        <a href="<?= $key ?>">
                            <i class="uil uil-plus-circle"></i>
                            <span class="link-name"><?= $value ?></span>
                        </a>
                    </li>
                <?php
                        }
                    }else if ($fetch_user_data['role'] == "nurse"){
                        foreach($nurse as $key => $value) {
                ?>
                    <li>
                        <a href="<?= $key ?>">
                            <i class="uil uil-plus-circle"></i>
                            <span class="link-name"><?= $value ?></span>
                        </a>
                    </li>
                <?php
                        }
                    }else if($fetch_user_data['role'] == "receptionist"){
                        foreach($receptionist as $key => $value) {
                ?>
                    <li>
                        <a href="<?= $key ?>">
                            <i class="uil uil-plus-circle"></i>
                            <span class="link-name"><?= $value ?></span>
                        </a>
                    </li>
                <?php
                        }
                    }else if($fetch_user_data['role'] == "doctor"){
                        foreach($doctor as $key => $value) {
                ?>
                    <li>
                        <a href="<?= $key ?>">
                            <i class="uil uil-plus-circle"></i>
                            <span class="link-name"><?= $value ?></span>
                        </a>
                    </li>
                <?php
                        }
                    }else if($fetch_user_data['role'] == "admin"){
                        foreach($admin as $key => $value) {
                ?>
                    <li>
                        <a href="<?= $key ?>">
                            <i class="uil uil-plus-circle"></i>
                            <span class="link-name"><?= $value ?></span>
                        </a>
                    </li>
                <?php
                        }
                    }
                ?>

            </ul>

            <ul class="logout-mode">
                <li class = "logout-btns">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                        <div>
                            <i class="uil uil-signout"></i>
                            <input type="submit" name = "logout" value="Logout">
                        </div>
                    </form>
                </li>
                <li class = "mode">
                    <a href="">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box" style = "<?= $display ?? "" ?>">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here....">
            </div>
            <div id = "model-open">
                <div>
                    <?php echo $fetch_user_data['username'] ?>
                </div>
                <img src="<?= $path ?>assets/images/<?= $fetch_user_data['profile_pic'] ?? 'profile.png' ?>">                    
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "<?= $path ?>setting_page.php">Settings</a>
        </div>

<!-- header file's common part ends here -->
    
