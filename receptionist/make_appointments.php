<?php 
    
    // ==================== roles 
    $path = "../";

    include("./roles.php");
    include("../header.php");


?>


<!-- header file's common part ends here -->


        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <span class="text">Schedule Appointments</span>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>

                <table class="activity-data" style = "overflow-x: auto;">

                    <thead>
                        <tr>
                            <th class="data names">
                                <div class="data-title">Patient's Name</div>
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
                            if(mysqli_num_rows($patient_data_new_old) > 0){
                                while($data = mysqli_fetch_assoc($patient_data_new_old)){
                        ?> 
                        
                        <!-- This table body data will be fetched by dynamically -->
                        <tr>
                            <td class="data names">
                                <div class="data-list">
                                    <?php 
                                        $patient_details = get_user_data($conn, $data['patient_id']);
                                        echo($patient_details['firstName'] ." " . $patient_details['lastName']);
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
                                        $doctor_details = get_user_data($conn, $data['doctor_id']);
                                        if(isset($doctor_details)):
                                            echo $doctor_details['firstName'] . " " . $doctor_details['lastName'];
                                        else:
                                            echo "---";
                                        endif;
                                    ?>
                                </div>
                            </td>
                            <td class="data status">
                                <div class="data-list">
                                    <!-- <button id = "view_btn" data-viewid = "<?php echo $fetch_user_data['id'] ?>">View</button> -->
                                    <a href = "./make_appointments_form.php?id=<?php echo $data['id'] ?>">View</a>
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