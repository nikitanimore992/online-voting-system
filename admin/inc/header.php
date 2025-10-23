<?php
    session_start();
    require_once ("./config.php");

    if (!isset($_SESSION['key']) || $_SESSION['key'] != "AdminKey") {
        header("Location: ../logout.php");
        exit();
    }

    // Optionally handle voter case
    // else if ($_SESSION['key'] == "VoterKey") {
    //     header("Location: dashboard.php");
    //     exit();
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
