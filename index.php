
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Login - Online Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/logo.gif" class="brand_logo" alt="Logo">
					</div>
				</div>
                <!-- php code  -->
                 <?php
                 if(isset($_GET['sign-up'])){
                    //  include('sign-up.php');
                 ?>


                            <div class="d-flex justify-content-center form_container">
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="su_username" class="form-control input_user" placeholder="Username" required />
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="number" name="su_contact_no" class="form-control input_pass" placeholder="contact #" required />
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="su_password" class="form-control input_pass" placeholder="password" required />
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="su_retype_password" class="form-control input_pass" placeholder="Retype password" required />
                                    </div> 
                
                <!-- su_username    su_contact_no    su_password    su_retype_password    sign_up_btn -->
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <button type="submit" name="sign_up_btn" class="btn login_btn">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                    
                            <div class="mt-4">
                                <div class="d-flex justify-content-center links text-white">
                                    Allready have an account? <a href="index.php" class="ml-2 text-white">Sign-In</a>
                                </div>
                            </div>

                <?php
                } else {
                    //  include('sign-in.php');
                    ?>

                            <div class="d-flex justify-content-center form_container">
                                <form>
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="" class="form-control input_user" value="" placeholder="username">
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="" class="form-control input_pass" value="" placeholder="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label text-white" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <button type="button" name="button" class="btn login_btn">Login</button>
                                    </div>
                                </form>
                            </div>
                    
                            <div class="mt-4">
                                <div class="d-flex justify-content-center links text-white">
                                    Don't have an account? <a href="?sign-up=1" class="ml-2 text-white">Sign Up</a>
                                </div>
                                <div class="d-flex justify-content-center links">
                                    <a href="#" class="text-white">Forgot your password?</a>
                                </div>
                            </div>

                 <?php   
                 }
                 ?>
                 <!-- php code  -->

				
			</div>
		</div>
	</div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>


<?php


// include('admin/inc/config.php');
require_once('admin/inc/config.php');
if(isset($_POST['sign_up_btn'])){

    //   <!-- su_username    su_contact_no    su_password    su_retype_password   -->

    include('admin/inc/config.php');

    $su_username = mysql_real_escape_string($db,$_POST['su_username']);
    $su_contact_no = mysql_real_escape_string($db,$_POST['su_contact_no']);
    $su_password = mysql_real_escape_string($db,$_POST['su_password']);
    $su_retype_password = mysql_real_escape_string($db,$_POST['su_retype_password']);
    $user_role = 'Voter';

    if($su_password == $su_retype_password){
        // insert Query
        mysqli_query($db, "INSERT INTO users (username, contact_no, password,user_role) VALUES ('".$su_username."','".$su_contact_no."','".$su_password."','".$user_role."')") or die (mysqli_error($db));
        // echo "<script>alert('Password and Retype password do not match');</script>";
        ?>

        
                <script> 
                    location.assign('index.php?registered=1&success=1')
                </script>
   
   
   <?php

    } else {
       
       echo " <script> 
            location.assign('index.php?sign-up=1&invalid=1')
        </script>";
        // $insert_query = "INSERT INTO users (username, contact_no, password) VALUES ('$su_username', '$su_contact_no', '$su_password')";
        // $run_query = mysqli_query($db, $insert_query);

        // if($run_query){
        //     echo "<script>alert('Registration successful. You can now login.'); window.location='index.php';</script>";
        // } else {
        //     echo "<script>alert('Registration failed. Please try again.');</script>";
        // }
    }
}

?>
