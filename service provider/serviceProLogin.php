<?php

include('./../Homepage/dbConnection.php');
session_start();

if (!isset($_SESSION['is_s_login'])) {
    if (isset($_POST['s_login'])) {
        $s_Email = $_POST['email'];
        $s_Pass = $_POST['pass'];
        $sql = "SELECT s_p_email, s_p_pass FROM s_provider_login WHERE s_p_email='$s_Email' AND s_p_pass='$s_Pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $text = '<div style="background-color: green; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px; ">Login Successful</div>';
            $_SESSION['is_s_login'] = TRUE;
            $_SESSION['email'] = $s_Email;
            echo "<script>location.href='./profile.php';</script>";
            exit;

        } else {
            $text = '<div style="background-color: red; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px; ">problem</div>';
        }
    }
} else {
    echo "<script>location.href='./profile.php';</script>";
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../Homepage/styles/styles.css">
    <script src="https://kit.fontawesome.com/99542186d9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&family=Poppins:wght@500&family=Roboto+Condensed&family=Work+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <title>Login</title>
</head>

<body>

    <section class="form" id="login">
        <h1 class="title">Service Provider Login Form</h1>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Email: </td>
                    <td><input type="email" name="email" placeholder="Enter Your Email" /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="pass" placeholder="Enter Your Password" /></td>
                </tr>
                <tr>
                    <td colspan="2" id="sb" class="btn">
                        <button type="submit" name="s_login">Login</button>

                        <button>Reset</button>
                    </td>

                </tr>

                <tr>
                    <td colspan="2" class="">
                        <?php
                        if (isset($text)) {
                            echo $text;
                        }
                        ?>
                        <span>Don't have an account? Please <a href="./serviceProReg.php">Register</a>
                        </span>

                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="">
                        <span><a href="./../Homepage/index.php">Back to Home</a>
                        </span>  
    
                    </td>
                </tr>
            </table>
        </form>

    </section>
</body>

</html>