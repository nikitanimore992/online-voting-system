
<!-- ✅ Before user login, check all elections and automatically update their status:
     - If an election's end date has passed → change status from 'Active' to 'Expired'
     - If the start date has arrived and election was 'Inactive' → change it to 'Active'-->
<?php
// ✅ Use proper PHP tag (<?php not just <?)
require_once(__DIR__ . "/admin/inc/config.php");

// ✅ Fetch all elections
$fetchElections = mysqli_query($db, "SELECT * FROM elections") or die(mysqli_error($db));

while ($data = mysqli_fetch_assoc($fetchElections)) {
    $starting_date = $data['starting_date'];
    $ending_date   = $data['ending_date'];
    $curr_date     = date("Y-m-d");
    $election_id   = $data["id"];
    $status        = $data['status'];

//      ✅ Before login, auto-update election status:
//      Active → Expired (if end date passed)
//      InActive → Active (if start date reached)

    // ✅ Convert to DateTime objects
    $date1 = date_create($curr_date);

    // ✅ If Active → check if it should expire
    if ($status == "Active") {
        $date2 = date_create($ending_date);
        $diff  = date_diff($date1, $date2);

        // If current date > ending date → mark as Expired
        if ((int)$diff->format("%R%a") < 0) {
            mysqli_query($db, "UPDATE elections SET status = 'Expired' WHERE id = '$election_id'")
                or die(mysqli_error($db));
        }
    }

    // ✅ If Inactive → check if it should become Active
    else if ($status == "InActive") {
        $date2 = date_create($starting_date);
        $diff  = date_diff($date1, $date2);

        // If current date >= starting date → make it Active
        if ((int)$diff->format("%R%a") <= 0) {
            mysqli_query($db, "UPDATE elections SET status = 'Active' WHERE id = '$election_id'")
                or die(mysqli_error($db));
        }
    }
}
?>





<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>
<head>
	<title>Login - Online Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/images/logo.gif" class="brand_logo" alt="Logo">
					</div>
				</div>

                <?php if(isset($_GET['sign-up'])) { ?>
                    <!-- SIGN UP FORM -->
                    <div class="d-flex justify-content-center form_container">
                        <form method="POST" action="">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="su_username" class="form-control input_user" placeholder="Username" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="number" name="su_contact_no" class="form-control input_pass" placeholder="Contact Number" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_password" class="form-control input_pass" placeholder="Password" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_retype_password" class="form-control input_pass" placeholder="Retype Password" required />
                            </div> 
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="sign_up_btn" class="btn login_btn">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links text-white">
                            Already have an account? <a href="index.php" class="ml-2 text-white">Sign-In</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <!-- LOGIN FORM -->
                            <div class="d-flex justify-content-center form_container">
                                <form method="POST" action="">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="contact_no" class="form-control input_user"  placeholder="contact no" required />
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control input_pass" placeholder="password" required />
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <button type="submit" name="Login_btn" class="btn login_btn">Login</button>
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
			</div>
		</div>
	</div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once('admin/inc/config.php');

// Enable error display (for debugging only - remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['sign_up_btn'])) {
    $su_username = mysqli_real_escape_string($db, $_POST['su_username']);
    $su_contact_no = mysqli_real_escape_string($db, $_POST['su_contact_no']);
    $su_password = $_POST['su_password'];
    $su_retype_password = $_POST['su_retype_password'];
    $user_role = 'Voter';

    // ✅ Check if passwords match
    if ($su_password === $su_retype_password) {

        // ✅ Check if contact number already exists
        $check_stmt = $db->prepare("SELECT id FROM userss WHERE contact_no = ?");
        $check_stmt->bind_param("s", $su_contact_no);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Number already registered
            echo "<script>
                alert('❌ This contact number is already registered!');
                window.location='index.php?sign-up=1&duplicate=1';
            </script>";
        } else {
            // ✅ Hash the password
            $hashed_password = password_hash($su_password, PASSWORD_DEFAULT);

            // ✅ Insert new user
            $stmt = $db->prepare("INSERT INTO userss (username, contact_no, password, user_role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $su_username, $su_contact_no, $hashed_password, $user_role);

            if ($stmt->execute()) {
                echo "<script>
                    alert('✅ Registration successful!');
                    window.location='index.php?registered=1&success=1';
                </script>";
            } else {
                echo "<script>
                    alert('❌ Registration failed. Please try again.');
                    window.location='index.php?sign-up=1&failed=1';
                </script>";
            }

            // Close prepared statement
            $stmt->close();
        }

        // Close check statement
        $check_stmt->close();
    } else {
        echo "<script>
            alert('⚠️ Passwords do not match!');
            window.location='index.php?sign-up=1&invalid=1';
        </script>";
    }
}else if(isset($_POST['Login_btn'])) {
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $password = $_POST['password'];

    // Fetch user from userss table
    $stmt = $db->prepare("SELECT id, username, password, user_role FROM userss WHERE contact_no = ?");
    $stmt->bind_param("s", $contact_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Start session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['user_role'];

            // Redirect based on user_role
            if ($user['user_role'] == "Admin") {

                $_SESSION['key']="AdminKey";
                
                echo "<script>location.assign('admin/index.php?homepage=1');</script>";
            } else if ($user['user_role'] == "Voter") {

                $_SESSION['key']="VoterKey";

                echo "<script>location.assign('voters/index.php');</script>";
            } else {
                echo "<script>
                    alert('❌ Unknown user role!');
                    window.location='index.php';
                </script>";
            }

        } else {
            echo "<script>
                alert('❌ Incorrect password!');
                window.location='index.php?login=failed';
            </script>";
        }

    } else {
        echo "<script>
            alert('❌ No account found with this contact number!');
            window.location='index.php?login=failed';
        </script>";
    }

    $stmt->close();
}
?>


