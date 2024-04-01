

    <!-- ======= external js link ======== -->
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/profile_pic.js"></script>

    <!-- ======== jquery link ========= -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- ajax code -->
    <script>
        $(document).ready(function(){
           
            // editing record data from table
            $(document).on("click", "#edit", function(){
                $("#model").show();
            });

            // closing popup box
            $(document).on("click",".close-btn", function(){
                $("#model").hide();
            });

            // setting button for profile page
            $("#model-box").hide();
            $("#model-open").on("click", function(){
                $("#model-box").fadeToggle();
            });
        });
    </script>

            
</body>
</html>

