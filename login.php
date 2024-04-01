<?php 

    if(isset($_POST['submit'])){
        // session_start();
        include("config.php");

        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users_data WHERE (email = '{$user}' AND password = '{$pass}')";
        $result = mysqli_query($conn, $query) or die("Query Failed of login page");

        if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result) == 1){
            session_start();
            session_unset();
            $data = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $data['email'];
            header("Location: index.php");
            exit();
        }else{
            while($data = mysqli_fetch_assoc($result)){
                echo $data['email'];
            }
            
            echo "Database Conflict";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            background-color: aliceblue;
            background: linear-gradient(to right, rgb(147, 224, 239) 50%, rgb(6, 51, 107) 50%);
        }

        #error{
            position: absolute;
            top: 10vh;
            left: 40vw;
            right: 40vw;
            bottom: 0;
            height: 50px;
            width: 20vw;
            background-color: red;
            color: white;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            border-radius: 5px;
            border: 1px solid red;
        }
        #login-section{
            background-color: aliceblue;
            height: 90vh;
            width: 90vw;
            margin: 5vh 5vw;
            display: flex;
            flex-direction: row;
            border-radius: 25px;
        }

        #login-section div{
            width: 50%;
        }

        #login-details{
            background-color: rgb(249, 249, 249);
            border-radius: 25px;
            height: auto;
            display: flex;
            flex-direction: column;
            width: 100%;
            padding: 50px 100px;
        }

        #login-details div{
            width: 100%;
        }
        
        #login-details .login-logo{
            height: 80px;
            width: 100%;
            /* background-color: antiquewhite; */
            text-align: center;
            padding-top: 20px;
            font-size: 30px;
            box-sizing: border-box;

        }
        
        #login-details .welcome{
            height: 70px;
            width: 100%;
            /* background-color: antiquewhite; */
            text-align: center;
            /* padding-top: 25px; */
            font-size: 30px;
            box-sizing: border-box;

        }
        
        #login-details .google{
            height: 50px;
            width: 100%;
            /* background-color: rgb(240, 240, 240); */
            border: 1px solid #F0F0F0;
            box-shadow: 1px 1px 10px #d4d1d1;
            text-align: center;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }
       
        #login-details .options{
            height: 50px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }
        
        #login-details .options hr{
            width: 120px;
        }
        
        
        #login-details div input[ type = 'text'], #login-details div input[ type = 'password']{
            height: 50px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #F0F0F0;
            box-shadow: 1px 1px 10px #d4d1d1;
            background-color: rgb(249, 249, 249);
            /* border: 1px solid #F0F0F0; */
            padding: 5px 0px 5px 20px;
        }

        #login-details div div input[type = "submit"]{
            height: 50px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #F0F0F0;
            box-shadow: 1px 1px 10px #d4d1d1;
            background-color: rgb(11, 34, 98);
            /* border: 1px solid #F0F0F0; */
            padding: 5px 0px 5px 0px;
            color: white;
            cursor: pointer;
        }

        #login-details #remember{
            margin: 20px 0px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0px 5px;
        }
        
        #login-details #remember .forgot{
            text-align: end;
        }
        
        #login-details #have-acc{
            text-align: center;
        }


        #login-decor{
            background-color:rgb(160, 199, 247);
            border-radius: 0 25px 25px 0;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        #login-decor img{
            width: 500px;
        }

    </style>

</head>
<body>

    <section id = "error">Please Login Again</section>

    <section id = "login-section">
        <div id = "login-details">
            <div class = "login-logo">Logo</div>
            <div class = "welcome">Welcome Back</div>
            <div class = "google"><i class="uil uil-google"></i>Login With Google</div>
            <div class = "options">
                <hr>
                <span>
                    OR LOGIN WITH EMAIL
                </span>
                <hr>
            </div>

            <div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name = "username" placeholder="Your Email">
                    <input type="password" name = "password" placeholder="Your Password">
                    <div id = "remember">
                        <div>
                            <input type="checkbox" id="logged">
                            <label for="logged">Keep me logged in</label>
                        </div>
                        <div class = "forgot">
                            <a href="#">Forgot Password</a>
                        </div>
                    </div>
                    <div>
                        <input type="submit" name = "submit" value="Log in">
                    </div>

                    <hr style = "width: 100%; margin: 25px 0px;">

                    <div id = "have-acc">
                        Don't have an account yet? 
                        <a href="./registration.php">
                            Sign up
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div id = "login-decor">
            <img src="./assets/images/illustration2.png" alt="">
        </div>
        
    </section>

    <script>

        $(document).ready(function (){
            $("#error").hide();
        });

    </script>
</body>
</html>

