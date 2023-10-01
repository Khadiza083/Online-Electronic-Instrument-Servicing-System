<?php
include('dbConnection.php');
session_start();

if (isset($_POST['u_signup'])) {

    $sql = "SELECT u_email FROM user_login WHERE u_email = '".$_REQUEST['email']."'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $regMsg = '<div style="background-color: red; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Email ID already registered</div>';
    } else {
        $u_Name = $_POST['name'];
        $u_Email = $_POST['email'];
        $u_Pass = $_POST['pass'];

        $sql = "INSERT INTO user_login(u_name, u_email, u_pass) VALUES('$u_Name', '$u_Email','$u_Pass')";

        if ($conn->query($sql) == TRUE) {
            $regMsg = '<div style="background-color: green; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Account created successfully</div>';
        } else {
            echo "Unable to create";
        }
    }

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
    <title>ServiceProviderRegistration</title>
</head>
<body>
    <section class="form" id="registration">
        <h1 class="title">Create an Account as a serviceProvider</h1>
        <table>
            <tr>
                <td>User Name: </td>
                <td><input type="text" name="name" placeholder="Enter your name"></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="email" name="email" placeholder="Enter Your Email" /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="pass" placeholder="Enter Your Password" /></td>
            </tr>


            <tr>
                <td>Servicing centre name</td>
                <td><input type="text" /></td>
            </tr>
            <tr>
                <td>What do you able to service? </td>
                <td>
                    <select id="district">
                        <option value="volvo">Laptop</option>
                        <option value="saab">Desktop</option>
                        <option value="opel">Fan</option>
                        <option value="audi">UPS</option>
                        <option value="audi">CPU</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>District </td>
                <td>
                    <select id="district">
                        <option value="volvo">Dhaka</option>
                        <option value="saab">Gazipur</option>
                        <option value="opel">Jashore</option>
                        <option value="audi">Chattogram</option>
                        <option value="audi">Feni</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mobile no. </td>
                <td><input type="number" /></td>
            </tr>


            <tr>
                <td colspan="2" id="sb" class="btn">
                    <button>Register</button>

                    <button>Reset</button>
                </td>


            </tr>


            <tr>
                <td colspan="2" class="">
                    <span>Do you have any account? please <a href="#login">login</a>
                    </span>
                </td>
            </tr>

        </table>
    </section>
</body>

</html>