<?php 
    
    
    include("./config.php");
    if(isset($_POST['submit'])){

        $query = "  INSERT INTO 
                        `prescription_data`(patient_med_id, doctor_or_nurse_id, diagnosis) 
                    VALUES
                        (
                            '{$_POST['patient_med_id']}',
                            '{$_POST['nurse_or_doctor']}',
                            '{$_POST['diagnosis']}'
                        )";


        if(mysqli_query($conn, $query)) {
            $query2 = "UPDATE `patients_medical_details` SET `status` = 'completed' WHERE id = '{$_POST['patient_med_id']}'";
            if(mysqli_query($conn, $query2)) {
                header("Location: ./index.php");
                exit();
            }else {
                echo "Update query failed";
                exit();
            }
        }else {
            die("Insert query failed" . mysqli_error($conn));
        }
    }


    $path = "./";
    include("./roles.php");
    include("./header.php");

    if(isset($_GET['dp_id'])) {
        $med_id = $_GET['dp_id'];
        
        $patient_medical_data_info = get_patient_details($conn, $med_id);
        $patient_medical_data = mysqli_fetch_array($patient_medical_data_info);
        
        $patient_detail = get_user_data($conn, $patient_medical_data['patient_id']);
    }elseif(isset($_GET['np_id'])) {
        $med_id = $_GET['np_id'];
        
        $patient_medical_data_info = get_patient_details($conn, $med_id);
        $patient_medical_data = mysqli_fetch_array($patient_medical_data_info);
        
        $patient_detail = get_user_data($conn, $patient_medical_data['patient_id']);
    }

?>
<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Write Prescription</span>
                </div>
            </div>

            <div id = "result-data">
                <div class="success-result"></div>
                <div class="error-result"></div>
            </div>

            <form action="" method="POST" id = "form-data">
                <div>
                    <input type="hidden" name = "role" value = "receptionist">
                </div>
                <div>
                    <label for="fname">First Name</label>
                    <input type="text" id = "fname" name = "fname" value = "<?php echo $patient_detail['firstName'] ? $patient_detail['firstName'] : "" ; ?>" disabled>
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id = "lname" name = "lname" value = "<?php echo $patient_detail['lastName'] ? $patient_detail['lastName'] : "" ; ?>" disabled>
                </div>
                <div>
                    <label for="gender">Gender</label>
                    <input type="text" id = "gender" name = "gender" value = "<?php echo $patient_detail['gender'] ? $patient_detail['gender'] : "" ; ?>" disabled>
                </div>
                <div>
                    <label for="age">Age</label>
                    <input type="text" id = "age" name = "age">
                </div>
                <div>
                    <label for="weight">Weight</label>
                    <input type="text" id = "weight" name = "weight">
                </div>
                <div>
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" id = "diagnosis" name = "diagnosis">
                    <input type="hidden" name = "patient_med_id" value = "<?= $patient_medical_data['id'] ?>">
                    <input type="hidden" name = "nurse_or_doctor" value = "<?= $med_id ?? "" ?>">
                </div>

                <div class = "form-btn">
                    <input type="reset" name = "reset">
                    <input type="submit" value="Submit" name = "submit">
                </div>
            </form>
    
        </div>


<!-- footer file's start here -->
</section>

<?php 

    include("./footer.php");
?>