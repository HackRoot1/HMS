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
                    <a href="./receptionist/add_duties.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Add&nbsp;Duties</span>
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
                <img src="./assets/images/<?php echo $fetch_user_data['profile_pic']; ?>">                    
                <i class="uil uil-angle-down"></i>
            </div>
        </div>
        <div id="model-box">
            <a href = "./setting_page.php">Settings</a>
        </div>

<!-- header file's common part ends here -->
    






        <section id = "form-section">
            <div class="login-form">
                <form action="./update_setting_page.php" method = "POST" enctype="multipart/form-data">
                <!-- <form action="" method = "POST" enctype="multipart/form-data"> -->
                    <div>
                        <label for="preview">Profile Preview: </label>   
                        <?php 
                            if($fetch_user_data['profile_pic']){
                        ?>
                            <img src="./assets/images/<?php echo $fetch_user_data['profile_pic'] ?>" alt="Profile pic" width="100px" height="100px">
                        <?php
                            }else{
                                echo "Please Select Profile pic";
                            }
                        ?>                     
                        <!-- <img src="../assets/images/profile.png" alt="Profile pic" width="100px" height="100px"> -->
                    </div>
                    
                    <div>
                        <label for="fname">First Name:</label>
                        <input type="text" name = "firstName" id = "fname" value="<?php echo $fetch_user_data['firstName'] ? $fetch_user_data['firstName'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div>
                        <label for="lname">Last Name:</label>
                        <input type="text" name = "lastName" id = "lname" value="<?php echo $fetch_user_data['lastName'] ? $fetch_user_data['lastName'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div>
                        <label for="email">email:</label>
                        <input type="text" name = "email" id = "email" value="<?php echo $fetch_user_data['email'] ? $fetch_user_data['email'] : "" ; ?>" placeholder="Enter your username">
                    </div>
                    
                    <div>
                        <label for="profile">Profile:</label>
                        <input type='file' name = 'profile' id = 'profile'>
                    </div>

                    <div>
                        <label for="user">User Name:</label>
                        <input type="text" name = "username" id = "user" value="<?php echo $fetch_user_data['username'] ? $fetch_user_data['username'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div class = "form-btn">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Submit" name = "submit">
                    </div>
                </form>
            </div>
        </section>


                
<?php 
    include("./footer.php");
?>