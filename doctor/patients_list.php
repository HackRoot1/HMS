<?php 
    
    include("../header.php");
    
    // getting all user data - the user is one who is logged in
    // $roles_data = get_all_roles_data($conn, 'patient');
    $roles_data = get_all_patients_data($conn);

?>

<!-- header file's common part ends here -->
    

        <div class="dash-content">

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <span class="text">Patient's Lists</span>
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
                                <div class="data-title">Decease</div>
                            </th>
                            <th class="data joined">
                                <div class="data-title">Symptoms</div>
                            </th>
                            <th class="data type">
                                <div class="data-title">Date</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Time</div>
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
                                    $unique_data = get_user_data($conn, $data['patient_id']);
                                    $data2 = mysqli_fetch_assoc($unique_data);
                        ?> 
                        
                        <!-- This table body data will be fetched by dynamically -->
                        <tr>
                            <td class="data names">
                                <div class="data-list">
                                    <?php 
                                        echo $data2['firstName'] . " " . $data2['lastName'];
                                    ?>
                                </div>
                            </td>
                            <td class="data email">
                                <div class="data-list"><?php echo $data2['email'] ?></div>
                            </td>
                            <td class="data joined">
                                <div class="data-list"><?php echo $data['decease'] ?></div>
                            </td>
                            <td class="data type">
                                <div class="data-list"><?php echo $data['symptoms'] ?></div>
                            </td>
                            <td class="data type">
                                <div class="data-list"><?php echo $data['appointment_date'] ?></div>
                            </td>
                            <td class="data status">
                                <div class="data-list"><?php echo $data['appointment_time'] ?></div>
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