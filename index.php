<?php 

    $path = "./";
    
    include("./roles.php");
    include("./header.php");

?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
            </div>
            
            
            <div class="boxes">
                <!-- loading data and displaying here from page load_pending_or_completed_data.php -->
                
                <div class="box box1">
                    <span class="text">Total Appointments :</span>
                    <span class="number">
                        <?= $patient_total_appointment_count->num_rows ?? "0"  ?>
                    </span>
                </div>
                
                <div class="box box2">
                    <span class="text">Completed Appointments :</span>
                    <span class="number">
                        <?= $patient_complete_appointment_count->num_rows ?? "0"  ?>
                    </span>
                </div>
                
                <div class="box box3">
                    <span class="text">Pending Appointments :</span>
                    <span class="number">
                        <?= $patient_pending_appointment_count->num_rows ?? "0"  ?>
                    </span>
                </div>          
            </div>
            

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-two"></i>
                    <?php if($fetch_user_data['role'] == "receptionist"): ?>
                        <span class="text">Schedule Appointments</span>
                    <?php else: ?>
                        <span class="text">Your Appointments</span>
                    <?php endif; ?>
                </div>

                <div id = "result-data">
                    <div class="success-result"></div>
                    <div class="error-result"></div>
                </div>

                <table class="activity-data" style = "overflow-x:auto;">

                    <thead>
                        <tr>
                            <th class="data names">

                                <?php if($fetch_user_data['role'] == "patient"): ?>
                                    <div class="data-title">Name</div>
                                <?php else: ?>
                                        <div class="data-title">Patient's Name</div>
                                <?php endif; ?>

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
                                <div class="data-title">Status</div>
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
                                        if($fetch_user_data['role'] == "patient"):
                                            echo $fetch_user_data['firstName'] ." ". $fetch_user_data['lastName']; 
                                        else: 
                                            $patient_details = get_user_data($conn, $data['patient_id']);
                                            echo($patient_details['firstName'] ." " . $patient_details['lastName']);
                                        endif; 
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
                                    <?php echo $data['status']; ?>
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

    include("./footer.php");
?>