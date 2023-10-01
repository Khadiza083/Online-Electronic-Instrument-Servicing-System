<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Homepage/styles/styles.css">
    <link rel="stylesheet" href="./../Admin Panel/style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/99542186d9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&family=Poppins:wght@500&family=Roboto+Condensed&family=Work+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <title>
        <?php echo TITLE ?>
    </title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div class="navbar">
        <a href="./../../../OSMS/Homepage/index.php">
            <h2 class="logo">OEISS</h2>
        </a>
        <p>
            <?php echo $_SESSION['email']; ?>
        </p>


    </div>
    <div class="main-content">
        <div class="side-bar">
            <ul>
                <li class="<?php if (TITLE == 'User Profile') {
                    echo 'active';
                } ?>"><a href="userProfile.php">Profile</a>
                </li>
                <li class="<?php if (TITLE == 'Submit Request') {
                    echo 'active';
                } ?>"><a href="submitRequest.php">Submit
                        Request</a></li>
                <li class="<?php if (TITLE == 'Service Status') {
                    echo 'active';
                } ?>"><a href="serviceStatus.php">Service
                        Status</a></li>
                <li class="<?php if (TITLE == 'Change Password') {
                    echo 'active';
                } ?>"> <a href="changePass.php">Change
                        Password</a></li>
                <li class="<?php if (TITLE == 'Feedback') {
                    echo 'active';
                } ?>"> <a href="feeedback.php">Feedback</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">