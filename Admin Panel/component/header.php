<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Homepage/styles/styles.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./completed.css">
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
    <div class="navbar">
        <a href="./../../../OSMS/Homepage/index.php">
            <h2 class="logo">OEISS</h2>
        </a>


    </div>
    <div class="main-content">
        <div class="side-bar">
            <ul>
                <li class="<?php if(TITLE == 'Dashboard'){echo 'active';}?>"><a href="Dashboard.php">Dashboard</a></li>
                <li class="<?php if(TITLE == 'Completed Order'){echo 'active';}?>"><a href="completed.php">Completed Order</a></li>
                <li class="<?php if(TITLE == 'Confirm Order'){echo 'active';}?>"><a href="confirm.php">Confirm Order</a></li>
                <li  class="<?php if(TITLE == 'Manage Users'){echo 'active';}?>"><a href="Dashboard.php#users">Manage Users</a></li>
                <li class="<?php if(TITLE == 'Manage Service Providers'){echo 'active';}?>"> <a href="technicians.php">Manage Service Providers</a></li>
                

                <li ><a href="./logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
