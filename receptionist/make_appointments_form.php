<?php 
    
    // ==================== roles 
    $path = "../";

    include("./roles.php");
    include("../header.php");


    
    // ============== insert data into database using update command 

    $id = $_GET['id'];

    if(isset($_POST['book_appointment'])){

        $update_patients_details = "UPDATE 
                                    `patients_medical_details`
                                SET
                                receptionist_id = {$_POST['receptionist_id']},
                                nurse_id = {$_POST['nurse']},
                                doctor_id = {$_POST['doctor']},
                                appointment_date = '{$_POST['appoint_date']}',
                                appointment_time = '{$_POST['appoint_time']}'
                                WHERE
                                    id = {$id}
                                ";
        if(mysqli_query($conn, $update_patients_details)){
            header("Location: ../index.php");
        }
    }
    
    $fetch_query = "SELECT * FROM `patients_medical_details` WHERE id = {$id}";
    $fetch_query_data = mysqli_query($conn, $fetch_query);

    $fetch_data = mysqli_fetch_assoc($fetch_query_data);

    // print_r($fetch_data);
    // echo $fetch_data['patient_id'];
    // exit();
    $fetch_personal_data_query = "SELECT * FROM users_data WHERE id = {$fetch_data['patient_id']}";
    $fetch_personal_data = mysqli_query($conn, $fetch_personal_data_query);
    $fetch_personal_detail = mysqli_fetch_assoc($fetch_personal_data); 

    
    // fetching doctor's details
    $fetch_doctor_query = "SELECT * FROM users_data WHERE role = 'doctor'";
    $fetch_doctor_query_data = mysqli_query($conn, $fetch_doctor_query);
    
    // fetching nurse's details
    $fetch_nurse_query = "SELECT * FROM users_data WHERE role = 'nurse'";
    $fetch_nurse_query_data = mysqli_query($conn, $fetch_nurse_query);







    
?>
<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Add Duties</span>
                </div>
            </div>

            <div id = "result-data">
                <div class="success-result"></div>
                <div class="error-result"></div>
            </div>

            <form action="" method="POST" id = "form-data">
                <!-- pre-filled fields data get from database -->
                <div>
                    <label for="fname">First Name</label>
                    <input type="text" id = "fname" name = "fname" value = "<?php echo $fetch_personal_detail['firstName']; ?>" disabled>
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id = "lname" name = "lname" value = "<?php echo $fetch_personal_detail['lastName']; ?>" disabled>
                </div>
                
                <div>
                    <label for="gender">Gender</label>
                    <input type="text" id = "gender" name = "gender"  value = "<?php echo $fetch_personal_detail['gender']; ?>" disabled>
                </div>
                
                <div>
                    <label for="blood-grp">Blood Group</label>
                    <input type="text" id = "blood-grp" name = "blood-grp"  value = "<?php echo $fetch_data['blood_group']; ?>" disabled>
                </div>
                <div>
                    <label for="decease">Decease</label>
                    <input type="text" id = "decease" name = "decease"  value = "<?php echo $fetch_data['decease']; ?>" disabled>
                </div>
                <div>
                    <label for="symptoms">Symptoms</label>
                    <input type="text" id = "symptoms" name = "symptoms" value = "<?php echo $fetch_data['symptoms']; ?>" disabled>
                </div>
                <div>
                    <label for="medical_history">medical_history</label>
                    <input type="text" id = "medical_history" name = "medical_history" value = "<?php echo $fetch_data['medical_history']; ?>" disabled>
                </div>


                <!-- ============ updating data has been follows: =========== -->
                <div>
                    <!-- <label for="appoint_date">Appointment Date</label> -->
                    <input type="hidden" name = "receptionist_id" value = "<?php echo $fetch_user_data['id'] ?>" >
                </div>
                <div>
                    <label for="appoint_date">Appointment Date</label>
                    <input type="date" id = "appoint_date" name = "appoint_date" >
                </div>
                <div>
                    <label for="appoint_time">Appointment Time</label>
                    <input type="time" id = "appoint_time" name = "appoint_time" >
                </div>
                <div>
                    <label for="doctor">Select Doctor</label>
                    <select name="doctor" id="doctor" style = "width: 300px; height:40px;">
                        <?php 
                            if(mysqli_num_rows($fetch_doctor_query_data)){
                                while($data = mysqli_fetch_assoc($fetch_doctor_query_data)){
                        ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['firstName']; ?></option>
                        <?php
                                }
                            }else{
                        ?>
                            <option value="0">Doctor Not available</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="nurse">Select nurse</label>
                    <select name="nurse" id="nurse" style = "width: 300px; height:40px;">
                        <?php 
                            if(mysqli_num_rows($fetch_nurse_query_data)){
                                while($data = mysqli_fetch_assoc($fetch_nurse_query_data)){
                        ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['firstName']; ?></option>
                        <?php
                                }
                            }else{
                        ?>
                            <option value="0">Nurse Not available</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class = "form-btn">
                    <input type="reset" name = "reset">
                    <input type="submit" value="Submit" name = "book_appointment">
                </div>
            </form>
    
        </div>



        
<!-- footer file's start here -->
</section>

<?php 

    include("../footer.php");
?>