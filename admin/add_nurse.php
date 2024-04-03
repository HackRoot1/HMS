<?php 
    
    // ==================== roles 
    $path = "../";

    include("./roles.php");

    include("../config.php");
    // cannot use header if something is displayed on screen before using header()
    if(isset($_POST['edit_nurse'])){

        $query = "  UPDATE
                        `users_data`
                    SET 
                        firstName = '{$_POST['fname']}',
                        lastName = '{$_POST['lname']}',
                        email = '{$_POST['email']}',
                        shift = '{$_POST['shift']}',
                        contact_no = '{$_POST['m_no']}'
                    WHERE
                        id = '{$_POST['nurse_id']}'";

        if(mysqli_query($conn, $query) or die("Query Failed")) {
            header("Location: ../admin/nurses_list.php");
            exit();
        }
    }


    include("../header.php");
    include("../generate_pass.php");

    // Example: Generate a password with a length of 16 characters
    $password = generatePassword(16);
    

    
    if(isset($_POST['add_nurse'])){


        $query = "  INSERT INTO 
                        `users_data`
                        (role, firstName, lastName, email, shift, contact_no, password) 
                    VALUES
                        (
                            '{$_POST['role']}',
                            '{$_POST['fname']}',
                            '{$_POST['lname']}',
                            '{$_POST['email']}',
                            '{$_POST['shift']}',
                            '{$_POST['m_no']}',
                            '{$password}'
                        )";

        mysqli_query($conn, $query) or die("Query Failed");
    }

    if(isset($_GET['nurse_id'])) {
        $nurse_id = $_GET['nurse_id'];
        $nurse_data = get_user_data($conn, $nurse_id);
    }


?>
<!-- header file's common part ends here -->
    

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Add Nurse</span>
                </div>
            </div>

            <div id = "result-data">
                <div class="success-result"></div>
                <div class="error-result"></div>
            </div>

            <form action="" method="POST" id = "form-data">
                <div>
                    <input type="hidden" name = "<?php echo $nurse_data['id'] ? "nurse_id" : "role" ?>" value = "<?php echo $nurse_data['id'] ? $nurse_data['id'] : "nurse" ?>">
                </div>

                <div>
                    <label for="fname">First Name</label>
                    <input type="text" id = "fname" name = "fname" value = "<?= $nurse_data['firstName'] ?? "" ?>">
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id = "lname" name = "lname" value = "<?= $nurse_data['lastName'] ?? "" ?>">
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="text" id = "email" name = "email" value = "<?= $nurse_data['email'] ?? "" ?>">
                </div>
                <div>
                    <label for="shift">Shift</label>
                    <input type="text" id = "shift" name = "shift" value = "<?= $nurse_data['shift'] ?? "" ?>">
                </div>
                <div>
                    <label for="m_no">Contact No.:</label>
                    <input type="text" id = "m_no" name = "m_no" value = "<?= $nurse_data['contact_no'] ?? "" ?>">
                </div>

                <div class = "form-btn">
                    <input type="reset" name = "reset">
                    <input type="submit" value="Submit" name = "<?= isset($nurse_data['id']) ? "edit_nurse" : "add_nurse" ?>">
                </div>
            </form>
    
        </div>


<!-- footer file's start here -->
</section>

<?php 

    include("../footer.php");
?>