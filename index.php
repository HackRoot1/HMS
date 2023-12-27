<?php 

    include("./config.php");

    include("./db_queries.php");

    session_start();
    
    if(!$_SESSION['user']){
        header("Location: ./login.php");
    }
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('Location: ./login.php');
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
        $patient_data = get_all_patients_data_not_history($conn);
        // $patient_data = get_all_patient_data_on_roles($conn, 'receptionist_id', $fetch_user_data['id']);
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
    <link rel="stylesheet" href="./assets/css/style.css">
    
    <!-- =====  CSS ========= -->
    <link rel="stylesheet" href="./assets/css/registration.css">
    
    <!-- ===== Iconscout CSS ====== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="logo-name">
            <div class = "logo-image">
                <img src="./assets/images/logo.png" alt="">
            </div>

            <span class="logo_name">HMS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="./index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <?php 
                    if($fetch_user_data['role'] == "patient"){
                ?>
                
                <li>
                    <a href="./patient/book_appointment.php">
                        <i class="uil uil-plus-circle"></i>
                        <span class="link-name">Book&nbsp;Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="./history.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php
                    }else if ($fetch_user_data['role'] == "nurse"){
                ?>

                <li>
                    <a href="./nurse/view_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">View&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="./history.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php 
                    }else if($fetch_user_data['role'] == "receptionist"){
                ?>


                <li>
                    <a href="./receptionist/make_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Make&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="./history.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>

                <?php 
                    }else if($fetch_user_data['role'] == "doctor"){
                ?> 
                <li>
                    <a href="./doctor/patients_appointments.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Patient's&nbsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="./doctor/add_nurse.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Nurse</span>
                    </a>
                </li>
                <li>
                    <a href="./doctor/add_receptionist.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Receptionist</span>
                    </a>
                </li>
                <li>
                    <a href="./doctor/patients_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Patients&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./doctor/nurses_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Nurse&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./doctor/receptionists_list.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Receptionist&nbsp;Lists</span>
                    </a>
                </li>
                <li>
                    <a href="./history.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">History</span>
                    </a>
                </li>
                <?php 
                    }else if($fetch_user_data['role'] == "admin"){
                ?>
                <li>
                    <a href="./admin/patients_appointments.php">
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
                    <a href="./admin/patients_list.php">
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
                <img src="./assets/images/profile.png">                    
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "./setting_page.php">Settings</a>
        </div>

<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
            </div>
            
            
            <div class="boxes">
                <!-- loading data and displaying here from page load_pending_or_completed_data.php -->

                <div class="box box1">
                    <span class="text">Total Appointments :</span>
                    <span class="number">
                        3
                    </span>
                </div>
                
                <div class="box box2">
                    <span class="text">Completed Appointments :</span>
                    <span class="number">
                        2
                    </span>
                </div>
                
                <div class="box box3">
                    <span class="text">Pending Appointments :</span>
                    <span class="number">
                        1
                    </span>
                </div>          
            </div>
            

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <span class="text">Your Appointments</span>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>

                <table class="activity-data" style = "overflow-x:auto;">

                    <thead>
                        <tr>
                            <th class="data names">
                                <?php 
                                    if($fetch_user_data['role'] == "patient"){
                                ?>
                                    <div class="data-title">Name</div>
                                <?php 
                                    }else{
                                ?>
                                        <div class="data-title">Patient's Name</div>
                                <?php 
                                    }
                                ?>
                            </th>
                            <th class="data email">
                                <div class="data-title">Decease</div>
                            </th>
                            <th class="data joined">
                                <div class="data-title">Symptoms</div>
                            </th>
                            <th class="data type">
                                <div class="data-title">Appointment Date</div>
                            </th>
                            <th class="data type">
                                <div class="data-title">Appointment Time</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Doctor Name</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Status</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Action</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php 
                            if(mysqli_num_rows($patient_data) > 0){
                                while($data = mysqli_fetch_assoc($patient_data)){
                        ?> 
                        
                        <!-- This table body data will be fetched by dynamically -->
                        <tr>
                            <td class="data names">
                                <div class="data-list">
                                    <?php 
                                        // getting data from user's table if any user role is logged in 
                                        $sql = "SELECT * FROM users_data WHERE id = {$data['patient_id']}";
                                        $query = mysqli_query($conn, $sql);
                                        $value = mysqli_fetch_assoc($query);
                                        echo $value['firstName'] . " " . $value['lastName'];
                                    ?>
                                </div>
                            </td>
                            <td class="data email">
                                <div class="data-list"><?php echo $data['decease'] ?></div>
                            </td>
                            <td class="data joined">
                                <div class="data-list"><?php echo $data['symptoms'] ?></div>
                            </td>
                            <td class="data type">
                                <div class="data-list"><?php echo $data['appointment_date'] != "0000-00-00" ? $data['appointment_date'] : "---" ?></div>
                            </td>
                            <td class="data type">
                                <div class="data-list"><?php echo $data['appointment_time'] != "00:00:00" ? $data['appointment_time'] : "---" ?></div>
                            </td>
                            <td class="data status">
                                <div class="data-list">
                                    <?php 
                                        // echo $data['doctor_id'] != "0" ? $data['doctor_id'] : "---" 
                                    ?>
                                    <?php  
                                        $doctor_details = get_user_data($conn, $data['doctor_id']);
                                        $doctor = mysqli_fetch_assoc($doctor_details);
                                        if(isset($doctor)){
                                            echo $doctor['firstName'] . " " . $doctor['lastName'];
                                        }
                                    ?>
                                </div>
                            </td>
                            <td class="data status">
                                <div class="data-list">
                                    <?php echo $data['status']; ?>
                                </div>
                            </td>
                            <td class="data status">
                                <div class="data-list">
                                    <a href="">
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                
                        <?php
                                }
                            }else{
                        ?> 

                        <!-- Else part -->
                        <tr>
                            <td class="data names" colspan="5" style="text-align: center">
                                <div class="data-list">No records Found</div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>








<!-- footer file's start here -->
    </section>

<?php 

    include("./footer.php");
?>