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
                    <span class="text">Receptionist's Lists</span>
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
                                <div class="data-title">dob</div>
                            </th>
                            <th class="data status">
                                <div class="data-title">Action</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php 
                            if(mysqli_num_rows($list_of_receptionists) > 0){
                                while($data = mysqli_fetch_assoc($list_of_receptionists)){
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
                                <div class="data-list"><?php echo $data['dob'] ?></div>
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