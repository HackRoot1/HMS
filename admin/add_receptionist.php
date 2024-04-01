<?php 
    
    // ==================== roles 
    $path = "../";

    include("./roles.php");
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
                    <input type="hidden" name = "role" value = "receptionist">
                </div>
                <div>
                    <label for="fname">First Name</label>
                    <input type="text" id = "fname" name = "fname" >
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id = "lname" name = "lname" >
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="text" id = "email" name = "email">
                </div>
                <div>
                    <label for="dob">Date of Birth</label>
                    <input type="date" id = "dob" name = "dob" >
                </div>
                <div>
                    <label for="m_no">Date of Birth</label>
                    <input type="text" id = "m_no" name = "m_no" >
                </div>

                <div class = "form-btn">
                    <input type="reset" name = "reset">
                    <input type="submit" value="Submit" name = "add_receptionist">
                </div>
            </form>
    
        </div>


<!-- footer file's start here -->
</section>

<?php 

    include("../footer.php");
?>