<?php 
 
    $path = "./";

    include("./roles.php");
    include("./header.php");

    $p_id = $_GET['p_id'];

    $patient_medical_data_info = get_patient_details($conn, $p_id);
    $patient_medical_data = mysqli_fetch_array($patient_medical_data_info);

    $patient_data = get_user_data($conn, $patient_medical_data['patient_id']);


    $doctors_data = get_user_data($conn, $patient_medical_data['doctor_id']);
    $nurses_data = get_user_data($conn, $patient_medical_data['nurse_id']);


?>




        <section id = "patient-details">
            <div class="patient-info">                    
                <div>
                    <span>First Name:</span>
                    <span> <?php echo $patient_data['firstName'] ? $patient_data['firstName'] : "" ; ?> </span>

                </div>

                <div>
                    <span>Last Name:</span>
                    <span> <?php echo $patient_data['lastName'] ? $patient_data['lastName'] : "" ; ?></span>
                </div>

                <div>
                    <span>Decease:</span>
                    <span> <?php echo $patient_medical_data['decease'] ? $patient_medical_data['decease'] : "" ; ?></span>
                </div>
                

                <div>
                    <span>Symptoms:</span>
                    <span> <?php echo $patient_medical_data['symptoms'] ? $patient_medical_data['symptoms'] : "" ; ?></span>
                </div>
                
                <div>
                    <span>Blood Group:</span>
                    <span> <?php echo $patient_medical_data['blood_group'] ? $patient_medical_data['blood_group'] : "" ; ?></span>
                </div>
                
                <div>
                    <span>Doctor Name:</span>
                    <span><?php echo !empty($doctors_data['firstName']) ? $doctors_data['firstName'] : "---" ; ?> <?php echo !empty($doctors_data['lastName']) ? $doctors_data['lastName'] : "---" ; ?></span>
                </div>
                
                <div>
                    <span>Nurse Name:</span>
                    <span><?php echo !empty($nurses_data['firstName']) ? $nurses_data['firstName'] : "---" ; ?> <?php echo !empty($nurses_data['lastName']) ? $nurses_data['lastName'] : "---" ; ?></span>
                </div>

                <div>
                    <span>Appointment Date:</span>
                    <span> <?php echo $patient_medical_data['appointment_date'] ? $patient_medical_data['appointment_date'] : "" ; ?></span>
                </div>

                <div>
                    <span>Appointment Time:</span>
                    <span> <?php echo $patient_medical_data['appointment_time'] ? $patient_medical_data['appointment_time'] : "" ; ?></span>
                </div>

                <?php if($fetch_user_data['role'] == "patient"): ?>
                    <div class = "btns">
                        <a href="./cancel_appointment.php?up_id=<?= $patient_medical_data['id'] ?>">Cancel Appointment</a>
                        <a href="./patient/book_appointment.php?p_id=<?= $patient_medical_data['id'] ?>">Edit Appointment</a>
                    </div>
                <?php elseif($fetch_user_data['role'] == "nurse"): ?>
                    <div class = "btns">
                        <a href="./cancel_appointment.php?np_id=<?= $patient_medical_data['id'] ?>">Cancel Appointment</a>
                        <a href="./write_prescription.php?np_id=<?= $patient_medical_data['id'] ?>"">Write Prescription</a>
                    </div>
                <?php elseif($fetch_user_data['role'] == "receptionist"): ?>
                    <div class = "btns">
                        <a href="./cancel_appointment.php?dp_id=<?= $patient_medical_data['id'] ?>">Cancel Appointment</a>
                        <a href="./write_prescription.php?dp_id=<?= $patient_medical_data['id'] ?>"">Edit Appointment</a>
                    </div>
                <?php else: ?>
                    <div class = "btns">
                        <a href="./cancel_appointment.php?dp_id=<?= $patient_medical_data['id'] ?>">Cancel Appointment</a>
                        <a href="./write_prescription.php?dp_id=<?= $patient_medical_data['id'] ?>"">Write Prescription</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

                
<?php 
    include("./footer.php");
?>