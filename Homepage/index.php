<?php
include('./dbConnection.php');
session_start();
if (isset($_SESSION['is_login'])) {
    $login = '<li><a href="./../user-panel/userProfile.php">Your Profile</a></li>';
    $logout = '<li><a href="./logout.php">Logout</a></li>';

} else if (isset($_SESSION['is_admin_login'])) {
    $login = '<li><a href="./../Admin Panel/Dashboard.php">Dashboard</a></li>';
    $logout = '<li><a href="./logout.php">Logout</a></li>';
} else if (isset($_SESSION['is_s_login'])) {
    $login = '<li><a href="./../service provider/profile.php">Profile</a></li>';
    $logout = '<li><a href="./logout.php">Logout</a></li>';
} else {
    $login = '<li><a href="userLogin.php">login</a></li>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="https://kit.fontawesome.com/99542186d9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&family=Poppins:wght@500&family=Roboto+Condensed&family=Work+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <title>OEISS</title>
    <style>
        .customers {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-top: 100px;
            width: 100%;
        }

        .customer {
            box-shadow: 1px 2px 3px 4px rgba(241, 228, 228, 0.4);
            border-radius: 10px;
            width: 75%;
            margin-bottom: 50px;
            position: relative;
            padding: 40px;

        }

        .customer img {
            box-shadow: 1px 2px 3px 4px rgba(114, 113, 113, 0.4);
            border-radius: 50%;
            border: 1px solid white;
            width: 100px;
            position: absolute;
            top: -50px;
            left: 100px;
        }

       
    </style>
</head>

<body>

    <header class="header">
        <!-- navbar  -->
        <nav>
            <div><a href="index.php">
                    <h2 class="logo">OEISS</h2>
                </a></div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#registration">Registration</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#h-users">Our happy users</a></li>
                <li><a href="">Servicing centre</a></li>
                <?php if (isset($logout)) {
                    echo $logout;
                } ?>
                <li><a href=""><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <?php
                echo $login;
                ?>
            </ul>


        </nav>
        <!-- navbar end -->

        <div class="banner">
            <div>
                <h1 class="banner-title">Welcome to our servicing world!</h1>
                <p class="desc">Customer's happiness is our goal</p>
                <button><a href="userLogin.php" style="color: white;">Login</a></button>
                <button><a href="#registration" style="color: white;">Sign Up</a></button>
            </div>

        </div>
    </header>



    <main>
        <!-- registration -->
        <?php
        include('userRegistration.php')
            ?>
        <!-- end registration -->

        <!-- contact us form -->
        <?php include('ContactForm.php') ?>
        <!-- end contact us form -->

        <!-- Our Services -->

        <section id="services">

            <h1 class="title">Our Services</h1>
            <div class="services">
                <div class="service">
                    <div>
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h3>Electronic Appliances</h3>
                </div>
                <div class="service">
                    <div>
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <h3>Preventive Maintenance</h3>
                </div>
                <div class="service">
                    <div>
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h3>Fault Repair</h3>
                </div>
            </div>
        </section>


        <!-- Our happy customers -->
        <section id="h-users">
            <h1 class="title">See what people say</h1>

            <div class="customers">
                <?php
                include('./dbConnection.php');
                $sql = "SELECT * FROM feedback_tb";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="customer">
                        <div>
                            <img src="images/user-1.png" alt="">
                        </div>
                        <div style="margin-top: 20px;">
                            <p><i class="fa-solid fa-quote-left"></i>' . $row['u_msg'] . '<i class="fa-solid fa-quote-right"></i>
                            </p>
                            <h4>' . $row['u_name'] . '</h4>
                            <p>' . $row['u_city'] . '</p>
                        </div>
                    </div>';
                    }
                } else {
                    echo "There is no reviews";
                }
                ?>



            </div>
        </section>
    </main>
    <footer class="container">
        <div class="footer">
            <p class="primary-paragraph">All rights reserved copyright@2023 startup landing page design</p>
            <a href="./../Admin Panel/login.php">Admin Login</a>
        </div>
    </footer>
</body>

</html>