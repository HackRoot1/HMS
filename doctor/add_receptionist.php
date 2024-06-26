<?php 
    
    // ==================== roles 
    $path = "../";

    include("./roles.php");

    include("../config.php");
    // cannot use header if something is displayed on screen before using header()
    if(isset($_POST['edit_receptionist'])){

        $query = "  UPDATE
                        `users_data`
                    SET 
                        firstName = '{$_POST['fname']}',
                        lastName = '{$_POST['lname']}',
                        email = '{$_POST['email']}',
                        dob = '{$_POST['dob']}',
                        contact_no = '{$_POST['m_no']}'
                    WHERE
                        id = '{$_POST['receptionist_id']}'";

        if(mysqli_query($conn, $query) or die("Query Failed")) {
            header("Location: ../doctor/receptionists_list.php");
            exit();
        }
    }

    include("../header.php");
    include("../generate_pass.php");

    // Example: Generate a password with a length of 16 characters
    $password = generatePassword(16);



    if(isset($_POST['add_receptionist'])){


        $query = "  INSERT INTO 
                        `users_data`
                        (role, firstName, lastName, email, dob, contact_no, password) 
                    VALUES
                        (
                            '{$_POST['role']}',
                            '{$_POST['fname']}',
                            '{$_POST['lname']}',
                            '{$_POST['email']}',
                            '{$_POST['dob']}',
                            '{$_POST['m_no']}',
                            '{$password}'
                        )";

        mysqli_query($conn, $query) or die("Query Failed");
    }


    if(isset($_GET['receptionist_id'])) {
        $receptionist_id = $_GET['receptionist_id'];
        $receptionist_data = get_user_data($conn, $receptionist_id);
    }


?>
<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Add Receptionist</span>
                </div>
            </div>

            <div id = "result-data">
                <div class="success-result"></div>
                <div class="error-result"></div>
            </div>

            <form action="" method="POST" id = "form-data">
                <div>
                    <input type="hidden" name = "<?php echo $receptionist_data['id'] ? "receptionist_id" : "role" ?>" value = "<?php echo $receptionist_data['id'] ? $receptionist_data['id'] : "receptionist" ?>">
                </div>
                <div>
                    <label for="fname">First Name</label>
                    <input type="text" id = "fname" name = "fname" value = "<?= $receptionist_data['firstName'] ?? "" ?>">
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id = "lname" name = "lname" value = "<?= $receptionist_data['lastName'] ?? "" ?>" >
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="text" id = "email" name = "email" value = "<?= $receptionist_data['email'] ?? "" ?>">
                </div>
                <div>
                    <label for="dob">Date of Birth</label>
                    <input type="date" id = "dob" name = "dob" value = "<?= $receptionist_data['dob'] ?? "" ?>" >
                </div>
                <div>
                    <label for="m_no">Contact No.</label>
                    <input type="text" id = "m_no" name = "m_no" value = "<?= $receptionist_data['contact_no'] ?? "" ?>" >
                </div>

                <div class = "form-btn">
                    <input type="reset" name = "reset">
                    <input type="submit" value="Submit" name = "<?= isset($receptionist_data['id']) ? "edit_receptionist" : "add_receptionist" ?>">
                </div>
            </form>
    
        </div>


<!-- footer file's start here -->
</section>

<?php 

    include("../footer.php");
?>