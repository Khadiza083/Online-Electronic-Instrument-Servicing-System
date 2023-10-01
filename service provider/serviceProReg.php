<?php
include('./../Homepage/dbConnection.php');

if (isset($_POST['s_register'])) {

    $sql = "SELECT s_p_email FROM s_provider_login WHERE s_p_email = '" . $_REQUEST['s_email'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $regMsg = '<div style="background-color: red; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Email ID already registered</div>';
    } else {
        $sName = $_POST['s_name'];
        $sEmail = $_POST['s_email'];
        $sPass = $_POST['s_pass'];
        $sServicingCentre = $_POST['ser_cen_name'];
        $sServices = $_POST['service'];
        $sDistrict = $_POST['district'];
        $sMobile = $_POST['s_mobile'];
        // s_p_id 	s_p_name 	s_p_email 	s_p_pass 	s_p_servicingcentre 	s_p_services 	s_p_district 	s_p_mobile

        $sql = "INSERT INTO s_provider_reg(s_p_name, s_p_email, s_p_pass, s_p_servicingcentre, s_p_services, s_p_district, s_p_mobile) VALUES('$sName', '$sEmail','$sPass', '$sServicingCentre', ' $sServices', '$sDistrict', '$sMobile')";

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
    <link rel="stylesheet" href="./../Homepage/styles/styles.css">
    <title>Document</title>
</head>

<body>
    <section class="form" id="registration">
        <h1 class="title">Create an Account</h1>
        <form method="POST">
            <table>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="s_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="email" name="s_email" placeholder="Enter Your Email" /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="s_pass" placeholder="Enter Your Password" /></td>
                </tr>


                <tr>
                    <td>Servicing centre name</td>
                    <td><input type="text" name="ser_cen_name" /></td>
                </tr>
                <tr>
                    <td>What do you able to service? </td>
                    <td>
                        <select id="services" type="text" name="service">
                            <option value="Laptop">Laptop</option>
                            <option value="Desktop">Desktop</option>
                            <option value="Fan">Fan</option>
                            <option value="UPS">UPS</option>
                            <option value="CPU">CPU</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>District </td>
                    <td>
                        <select id="district" type="text" name="district">
                            <option value="Dhaka">Dhaka</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Jashore">Jashore</option>
                            <option value="Chattogram">Chattogram</option>
                            <option value="Feni">Feni</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mobile no. </td>
                    <td><input type="number" name="s_mobile" /></td>
                </tr>


                <tr>
                    <td colspan="2" id="sb" class="btn">
                        <button type="submit" name="s_register">Register</button>

                        <button>Reset</button>
                    </td>


                </tr>


                <tr>
                    <td colspan="2" class="">
                        <span>Do you have any account? please <a href="./serviceProLogin.php">login</a>
                            <?php
                            if (isset($regMsg)) {
                                echo $regMsg;
                            }
                            ;
                            ?>
                        </span>
                    </td>
                </tr>

            </table>

        </form>
    </section>
</body>

</html>