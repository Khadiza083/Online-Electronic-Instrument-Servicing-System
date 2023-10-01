<?php

include('./../Homepage/dbConnection.php');
session_start();

if (!isset($_SESSION['is_admin_login'])) {
    if (isset($_POST['a_email'])) {
        $admin_Email = trim($_POST['a_email']);
        $admin_Pass = trim($_POST['a_pass']);
        $sql = "SELECT admin_email, admin_pass FROM admin_login_tb WHERE admin_email='" . $admin_Email . "' AND admin_pass='" . $admin_Pass . "' limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // $msg = '<div style="background-color: #28a745; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px; ">Logged in successfully</div>';
            $_SESSION['is_admin_login'] = TRUE;
            $_SESSION['admin_email'] = $admin_Email;
            echo "<script>location.href='./Dashboard.php';</script>";
            exit;
        } else {
            $msg = '<div style="background-color: #ffc107; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px;">Enter valid email and password</div>';
        }
    }
} else{
    echo "<script>location.href='./Dashboard.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
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
        <h1 class="title">Admin Login Form</h1>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Email: </td>
                    <td><input type="email" name="a_email" placeholder="Enter Your Email" /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="a_pass" placeholder="Enter Your Password" /></td>
                </tr>
                <tr>
                    <td colspan="2" id="sb" class="btn">
                        <button type="submit" name="a_login">Login</button>
    
                        <button>Reset</button>
                    </td>
    
                </tr>
    
                <tr>
                    <td colspan="2" class="">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ;
                        ?>
                        <span>Don't have an account? Please <a href="#registration">Register</a>
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
