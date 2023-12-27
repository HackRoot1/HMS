<?php 

    include("../config.php");
    include("../db_queries.php");
    // include("../generate_pass.php");

    session_start();
    
    if(!$_SESSION['user']){
        header("Location: ../login.php");
    }
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('Location: ../login.php');
        exit();
    }

    // getting all user data - the user is one who is logged in
    $query = get_all_user_data($conn, $_SESSION['user']);
    $fetch_user_data = mysqli_fetch_assoc($query);

    if($fetch_user_data['role'] == 'patient'){
        $patient_data = get_only_logged_patient_data($conn, $fetch_user_data['id']);
    }else if($fetch_user_data['role'] == 'nurse'){
        $patient_data = get_all_patient_data_on_roles($conn, 'nurse_id', $fetch_user_data['id']);
    }else if($fetch_user_data['role'] == 'receptionist'){
        $patient_data = get_all_patient_data_on_roles($conn, 'receptionist_id', $fetch_user_data['id']);
    }else if($fetch_user_data['role'] == 'doctor'){
        $patient_data = get_all_patient_data_on_roles($conn, 'doctor_id', $fetch_user_data['id']);
    }else if($fetch_user_data['role'] == 'admin'){
        get_all_patients_data($conn);
    }



?>

<!-- Header file's common part -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="../assets/css/registration.css">
    
    <!-- ===== Iconscout CSS ====== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class = "logo-image">
                <img src="../assets/images/logo.png" alt="">
            </div>

            <span class="logo_name">HMS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="../index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <?php 
                    if($fetch_user_data['role'] == "patient"){
                ?>
                
                <li>
                    <a href="./book_appointment.php">
                        <i class="uil uil-plus-circle"></i>
                        <span class="link-name">Book&nbsp;Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="../history.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php
                    }else if ($fetch_user_data['role'] == "nurse"){
                ?>

                <li>
                    <a href="./view_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">View&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="../history.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php 
                    }else if($fetch_user_data['role'] == "receptionist"){
                ?>


                <li>
                    <a href="./make_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Make&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="../history.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>

                <?php 
                    }else if($fetch_user_data['role'] == "doctor"){
                ?> 
                <li>
                    <a href="./patients_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Patient's&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="./add_nurse.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Nurse</span>
                    </a>
                </li>
                <li>
                    <a href="./add_receptionist.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Receptionist</span>
                    </a>
                </li>
                <li>
                    <a href="./patients_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Patients&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./nurses_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Nurse&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./receptionists_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Receptionist&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="../history.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php 
                    }else if($fetch_user_data['role'] == "admin"){
                ?>
                <li>
                    <a href="./admins_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Patient's&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="./admin/add_nurse.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Nurse</span>
                    </a>
                </li>
                <li>
                    <a href="./admin/add_receptionist.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Receptionist</span>
                    </a>
                </li>
                <li>
                    <a href="./admins_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Patients&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./admin/nurses_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Nurse&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./admin/receptionists_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Receptionist&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./admin/doctors_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Doctors&nbsp;Lists</span>
                    </a>
                </li>
                <?php 
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
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here....">
            </div>
            <div id = "model-open">
                <div>
                    <?php echo $fetch_user_data['username'] ?>
                </div>
                <img src="../assets/images/profile.png">                    
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "../setting_page.php">Settings</a>
        </div>

<!-- header file's common part ends here -->
    