<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/completed.css">
    <script src="https://kit.fontawesome.com/99542186d9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&family=Poppins:wght@500&family=Roboto+Condensed&family=Work+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <title>
        <?php
            echo TITLE;
        ?>
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
        <p><?php echo $_SESSION['email'];?></p>


    </div>
    <div class="main-content">
        <div class="side-bar">
            <ul>
                <li class="<?php if(TITLE == 'Profile'){echo 'active';}?>"><a href="profile.php">Profile</a></li>
                <li class="<?php if(TITLE == 'View Order'){echo 'active';}?>"><a href="viewOrder.php">View Order</a></li>
                <li class="<?php if(TITLE == 'Confirmed Order'){echo 'active';}?>"><a href="confirmOrder.php">Confirmed Order</a></li>
               
               
                

                <li ><a href="./logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
