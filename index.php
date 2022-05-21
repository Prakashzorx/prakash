<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mukunda Foods Pvt Ltd</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            /* height: 100vh; */
            /* text-align: center; */
        }

        /*Trigger Button*/
        .login-trigger {
            font-weight: bold;
            color: #fff;
            background: linear-gradient(to bottom right, #ba434d, #360b0a);
            padding: 15px 30px;
            border-radius: 30px;
            position: relative;

        }

        /*Modal*/
        .close {
            color: #fff;
            transform: scale(1.2)
        }

        .modal-content {
            background: linear-gradient(to bottom right, #ba434d, #360b0a);
        }

        .modal-body {
            position: relative;
            padding:
        }

        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        .body1 {
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            /* height: 100vh;
	margin: -20px 0 50px; */
        }

        h1 {
            font-weight: bold;
            /*margin-top: 50px;*/
            /* margin-left: 20%; */
        }

        h2 {
            text-align: center;
            /* margin-left: 20%; */
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            /* font-size: 12px; */
            color: #ba434d;
        }

        a {
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }


        button {
            border-radius: 20px;
            border: 1px solid #BA434D;
            background-color: #BA434D;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 1200px;
            max-width: 100%;
            min-height: 500px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #ba434d, #360b0a);
            background: linear-gradient(to right, #ba434d, #360b0a);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        .error {
            color: red;
            font-size: 20px;
        }
    </style>
</head>

<body style="margin-top:0">


    <br><br>
    <div class="container">
        <script src="https://kit.fontawesome.com/f9275dded9.js" crossorigin="anonymous"></script>
        <div class="row">
            <div class="col-sm-4">
                <h1 style="margin-top: 10%">KITCHEN.<span>OS</span></h1>
                <h3><span>Mukunda</span> Foods Private Limited</h3>
            </div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">
                <!-- <h1 style="margin-top: 10%;"><a style="color:black;float:right;font-size: 26px;">ABOUT US</a></h1> -->
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">

                <div class="body1">
                    <br><br>
                    <img src="Iot.jpg" alt="" height="200px" width="auto">
                    <!--Trigger-->
                    <br><br>
                    <?php if (isset($_GET['error'])) { ?>

                        <p class="error"><?php echo $_GET['error']; ?></p>

                    <?php } ?>
                    <a class="login-trigger" href="#" data-target="#login" data-toggle="modal">Login</a>

                    <div id="login" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-body">
                                    <button data-dismiss="modal" class="close">&times;</button>
                                    <div class="container" id="container">
                                        <!-- <div class="form-container sign-up-container">
                                            <form action="#">
                                                <h1>Create Account</h1> -->
                                        <!-- <div class="social-container">
                                                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                                                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                                                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                                                </div> -->
                                        <!-- <span>Contact Administrator</span> -->

                                        <!-- <input type="text" placeholder="Name" />
                                                <input type="email" placeholder="Email" />
                                                <input type="password" placeholder="Password" /> -->
                                        <!-- <button>No Sign Up For admin</button>
                                            </form> -->
                                        <!-- </div> -->
                                        <!-- <div class="form-container "> -->
                                        <br><br><br><br>
                                        <form action="login.php" method="POST">
                                            <h1>Sign in</h1>
                                            <!-- <div class="social-container">
                                                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                                                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                                                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                                                </div> -->
                                            <span>or use your account</span>
                                            <input type="email" name="uname" placeholder="Email" />
                                            <input type="password" name="password" placeholder="Password" />
                                            <!-- <br>
                                            <div style="width: -webkit-fill-available;">
                                                <div class="col-lg-4">
                                                    <input type="radio" id="logintype1" name="logintype" value="admin">
                                                    <label for="logintype1">Admin</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="radio" id="logintype2" name="logintype" value="manager">
                                                    <label for="logintype2">Brand Manager</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="radio" id="logintype3" name="logintype" value="user">
                                                    <label for="logintype3">Brand User</label>
                                                </div>
                                            </div>
                                            <br> -->
                                            <br><br>
                                            <!-- <a href="#">Forgot your password?</a> -->
                                            <button>Sign In</button>
                                        </form>
                                        <!-- </div> -->
                                        <!-- <div class="overlay-container">
                                            <div class="overlay">
                                                <div class="overlay-panel overlay-left">
                                                    <h1>Welcome Back!</h1>
                                                    <p>To keep connected with us please login with your personal info</p>
                                                    <button class="ghost" id="signIn">Sign In</button>
                                                </div>
                                                <div class="overlay-panel overlay-right">
                                                    <h1>Hello, User!</h1>
                                                    <p>Enter your details and start journey with us</p>
                                                    <button class="ghost" id="signUp">Sign Up</button>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

            </div>
        </div>


        <!-- <div class="row">
           
            <div class="col-sm-12">
            <br><br><br><br>
                    <p style="text-align:center">Copyright@ 2021 <b>BRAVERY ENGINEERING AND SERVICES PVT PTD</b></p>
            </div>
          
        </div> -->
    </div>



    <script>
        // const signUpButton = document.getElementById('signUp');
        // const signInButton = document.getElementById('signIn');
        // const container = document.getElementById('container');

        // signUpButton.addEventListener('click', () => {
        //     container.classList.add("right-panel-active");
        // });

        // signInButton.addEventListener('click', () => {
        //     container.classList.remove("right-panel-active");
        // });
    </script>
</body>

</html>