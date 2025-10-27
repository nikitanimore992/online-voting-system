
<?php
session_start();
require_once(__DIR__ . "/../../admin/inc/config.php");

// Check if session key exists and is correct
if (!isset($_SESSION['key']) || $_SESSION['key'] != "VoterKey") {
    header("Location: /online-voting-system/admin/logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voters Panel - Online Voting System</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>


    <div class="container-fluid">
        <div class="row bg-black text-white">
            <div class="col-1">
                <img src="../assets/images/logo.gif" width="80px" alt="image not found">
            </div>   
            <div class="col-11 my-auto">
                <h3>ONLINE VOTING SYSTEM - <small> WELCOME <?php echo $_SESSION['username']; ?></small></h3>
            </div>
        </div>
 



