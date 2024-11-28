<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    

<head>
        <meta charset="UTF-8">
        <title>limkokwing Library Management System</title>
        <link rel="shortcut icon" href="dist/images/LUCT-Uganda-Logo.jpg" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <link rel="stylesheet" href="dist/vendors/flag-select/css/flags.css">
        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="dist/vendors/social-button/bootstrap-social.css"/>   
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <!-- END: Custom CSS-->
</head>
    <!-- END Head-->
<?php 
include('includes/connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = ($_POST['password']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);  
    if(empty($email) || empty($password)){
        $_SESSION['error'] = "Fill in all Fields";
        
    } else{
        $salt="codeflix";
        $password_encripted = sha1($password.$salt);
        $sql = "SELECT * FROM users WHERE email ='$email' AND Password = '$password_encripted'";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
        
        }
    }
    mysqli_close($conn);
}
?>
    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <img src="dist/images/LUCT-Uganda-Logo.jpg" alt="" class="d-block mx-auto img-fluid" width="100" >
				    <h1 class="text-center" style="font-family: serif;">Limkokwing University Library </h1>
                    <h4 class="text-center">Signin</h4>                    
                    <form action="#" method="POST" class="row row-eq-height lockscreen  mt-3 mb-5">
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                        
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo "<p style='color: red; text-align:center; border-radius:10%;' class='bg-warning p-2'>" . $_SESSION['error'] . "</p>";
                                unset($_SESSION['error']);
                            }
                            ?>
                       
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email </label>
                                <input class="form-control" type="email" id="email" name="email"  placeholder="Enter your email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password"  id="password" name="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>
                            
                            <div class="mt-2">Don't have an account? <a href="signup.php">Create an Account</a></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="dist/vendors/moment/moment.js"></script>
        <script src="dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->


</html>
