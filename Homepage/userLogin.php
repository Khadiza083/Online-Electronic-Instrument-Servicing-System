<?php

include('dbConnection.php');
session_start();

if (!isset($_SESSION['is_login'])) {
    if (isset($_POST['email'])) {
        $u_Email = trim($_POST['email']);
        $u_Pass = trim($_POST['pass']);
        $sql = "SELECT u_email, u_pass FROM user_login WHERE u_email='" . $u_Email . "' AND u_pass='" . $u_Pass . "' limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $msg = '<div style="background-color: #28a745; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px; ">Logged in successfully</div>';
            $_SESSION['is_login'] = TRUE;
            $_SESSION['email'] = $u_Email;
            echo "<script>location.href='../user-panel/userProfile.php';</script>";
            exit;
        } else {
            $msg = '<div style="background-color: #ffc107; color:white ; text-align: center; margin: 10px 0; padding: 3px 0; border-radius: 5px;">Enter valid email and password</div>';
        }
    }
} else{
    echo "<script>location.href='../user-panel/userProfile.php';</script>";
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
        <h1 class="title">User Login Form</h1>
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
                        <button type="submit" name="u_login">Login</button>
    
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
                        <span>Don't have an account? Please <a href="./index.php#registration">Register</a>
                        </span>
                        
    
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="">
                        <span><a href="./../service provider/serviceProLogin.php">Login as a service provider</a>
                        </span>  
    
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="">
                        <span><a href="./index.php">Back to Home</a>
                        </span>  
    
                    </td>
                </tr>
            </table>
        </form>
    
    </section>
</body>
</html>
