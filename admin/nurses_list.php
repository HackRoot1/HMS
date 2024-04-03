<?php 
    
    $path = "../";

    include("./roles.php");
    include("../header.php");

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
                            if(mysqli_num_rows($list_of_nurses) > 0){
                                while($data = mysqli_fetch_assoc($list_of_nurses)){
                        ?> 
                        
                        <!-- This table body data will be fetched by dynamically -->
                        <tr>
                            <td class="data names">
                                <div class="data-list">
                                    <?php echo $data['firstName'] . " " . $data['lastName'] ?>
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
                                    <a href="./delete_nurse.php?nurse_id=<?= $data['id'] ?>">Delete</a>
                                    <a href="./add_nurse.php?nurse_id=<?= $data['id'] ?>">Edit</a>
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