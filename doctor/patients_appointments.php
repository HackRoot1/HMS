<?php 

    include("../header.php");


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
<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <span class="text">Upcoming Appointments</span>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>

                <table class="activity-data">

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
                                        echo $doctor['firstName'] . " " . $doctor['lastName'];
                                    ?>
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

    include("../footer.php");
?>