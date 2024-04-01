<?php 
 
    $path = "./";

    include("./roles.php");
    include("./header.php");

?>







        <section id = "form-section">
            <div class="login-form">
                <form action="./update_setting_page.php" method = "POST" enctype="multipart/form-data">
                    <div>
                        <label for="preview">Profile Preview: </label>   
                        <img src="<?= $path ?>assets/images/<?php echo $fetch_user_data['profile_pic'] ?? "" ?>" id="previewImg" alt="Preview Image" style="max-width: 100px; max-height: 100px;">
                           
                        <!-- <img src="../assets/images/profile.png" alt="Profile pic" width="100px" height="100px"> -->
                    </div>
                    
                    <div>
                        <label for="fname">First Name:</label>
                        <input type="text" name = "firstName" id = "fname" value="<?php echo $fetch_user_data['firstName'] ? $fetch_user_data['firstName'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div>
                        <label for="lname">Last Name:</label>
                        <input type="text" name = "lastName" id = "lname" value="<?php echo $fetch_user_data['lastName'] ? $fetch_user_data['lastName'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div>
                        <label for="email">email:</label>
                        <input type="text" name = "email" id = "email" value="<?php echo $fetch_user_data['email'] ? $fetch_user_data['email'] : "" ; ?>" placeholder="Enter your username">
                    </div>
                    
                    <div>
                        <label for="profile">Profile:</label>
                        <input type='file' name = 'profile' accept="image/*" id = 'profile'>
                    </div>

                    <div>
                        <label for="user">User Name:</label>
                        <input type="text" name = "username" id = "user" value="<?php echo $fetch_user_data['username'] ? $fetch_user_data['username'] : "" ; ?>" placeholder="Enter your username">
                    </div>

                    <div class = "form-btn">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Submit" name = "submit">
                    </div>
                </form>
            </div>
        </section>

        <script>
        // Get reference to the input field and the preview image element
        const uploadInput = document.getElementById('profile');
        const previewImg = document.getElementById('previewImg');

        // Add event listener to the input field
        uploadInput.addEventListener('change', function() {
            // Check if any file is selected
            if (uploadInput.files && uploadInput.files[0]) {
                // Create a FileReader object
                const reader = new FileReader();

                // Set the image file to be read by the FileReader
                reader.readAsDataURL(uploadInput.files[0]);

                // Set up the onload event to set the src attribute of the preview image
                reader.onload = function(e) {
                previewImg.src = e.target.result; // Set the src attribute with the data URL
                previewImg.style.display = 'block'; // Make the preview image visible
                };
            }
        });

    </script>
                
<?php 
    include("./footer.php");
?>