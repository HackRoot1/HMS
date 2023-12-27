<?php 
    session_start();
    if(!$_SESSION['user']){
        header("Location: login.html");
    }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: login.html");
    }

    include("../header.php");
    
    // getting all user data - the user is one who is logged in
    $roles_data = get_all_roles_data($conn, 'nurse');
    
?>

<!-- header file's common part ends here -->
    

        <div class="dash-content">

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <span class="text">Nurses Lists</span>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>


                <table class="activity-data">
                    <thead>
                        <tr>
                            <th class="data names">
                                <div class="data-title">Name</div>
                            </th>
                            <th class="data email">
                                <div class="data-title">E-mail</div>
                            </th>
                            <th class="data email">
                                <div class="data-title">Shift</div>
                            </th>
                            <th class="data joined">
                                <div class="data-title">Contact</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Action</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php 
                            if(mysqli_num_rows($roles_data) > 0){
                                while($data = mysqli_fetch_assoc($roles_data)){
                        ?> 
                        
                        <!-- This table body data will be fetched by dynamically -->
                        <tr>
                            <td class="data names">
                                <div class="data-list">
                                    <?php 
                                        echo $data['firstName'] . " " . $data['lastName'];
                                    ?>
                                </div>
                            </td>
                            <td class="data email">
                                <div class="data-list"><?php echo $data['email'] ?></div>
                            </td>
                            <td class="data email">
                                <div class="data-list"><?php echo $data['shift'] ?></div>
                            </td>
                            <td class="data email">
                                <div class="data-list"><?php echo $data['contact_no'] ?></div>
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