<?php 
    
    // ==================== roles 
    $path = "../";
    $display = "display: none;";
    
    include("./roles.php");
    include("../header.php");
    
    $id = $fetch_user_data['id'];


    if(isset($_POST['book_appointment'])){

        $blood_group  = $_POST['blood_group'];
        $decease = $_POST['decease'];
        $symptoms = $_POST['symptoms'];
        $medical_history = $_POST['medical_history'];
        
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];

        $patient_data_query = " UPDATE 
                                    users_data
                                SET 
                                    dob = '{$dob}', 
                                    gender = '{$gender}',
                                    contact_no = '{$contact_no}',
                                    address = '{$address}' 
                                WHERE 
                                    id = '{$id}'
                                    ";
                                
        $patient_data = mysqli_query($conn, $patient_data_query) or die("patients data query failed.");
        
        $patients_medical_data_query = "INSERT INTO 
                                            patients_medical_details
                                            (
                                                patient_id, 
                                                blood_group, 
                                                decease, 
                                                symptoms, 
                                                medical_history
                                            ) 
                                        VALUES
                                            (
                                                '{$id}', 
                                                '{$blood_group}', 
                                                '{$decease}', 
                                                '{$symptoms}', 
                                                '{$medical_history}'
                                            )";
        $patients_medical_data = mysqli_query($conn, $patients_medical_data_query) or die("medical details query failed.");
        header("Location: ../index.php");
        exit();
    }
?>
<!-- header file's common part ends here -->


    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Book Appointment</span>
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
                <input type="text" id = "fname" name = "fname" value = "<?php echo $fetch_user_data['firstName']; ?>">
            </div>
            <div>
                <label for="lname">Last Name</label>
                <input type="text" id = "lname" name = "lname" value = "<?php echo $fetch_user_data['lastName']; ?>">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="text" id = "email" name = "email" value = "<?php echo $fetch_user_data['email'] ? $fetch_user_data['email'] : "" ?>" disabled>
            </div>
            
            <!-- following records will update in database -->
            <div>
                <label for="dob">Date of Birth</label>
                <input type="date" id = "dob" name = "dob" value="<?php echo $fetch_user_data['dob'] ?$fetch_user_data['dob']: "" ; ?>">
            </div>
            <div>
                <label for="m_no">Contact No.:</label>
                <input type="text" id = "m_no" name = "m_no">
            </div>
            
            <div>
                <label for="gender">Gender</label>
                <input type="text" id = "gender" name = "gender" value="<?php echo $fetch_user_data['gender'] ?$fetch_user_data['gender']: "" ; ?>" >
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" id = "address" name = "address">
            </div>
            
            <div>
                <label for="blood-grp">Blood Group</label>
                <input type="text" id = "blood-grp" name = "blood_group">
            </div>
            <div>
                <label for="decease">Decease</label>
                <input type="text" id = "decease" name = "decease">
            </div>
            <div>
                <label for="symptoms">Symptoms</label>
                <input type="text" id = "symptoms" name = "symptoms">
            </div>
            <div>
                <label for="medical_history">medical_history</label>
                <input type="text" id = "medical_history" name = "medical_history">
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