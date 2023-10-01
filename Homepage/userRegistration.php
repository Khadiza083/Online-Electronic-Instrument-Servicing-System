<?php
include('dbConnection.php');

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

<section class="form" id="registration">
    <h1 class="title">Create an Account</h1>
    <form action="" method="POST">
        <table>
            <tr>
                <td>User Name: </td>
                <td><input type="text" name="name" placeholder="Enter your name" required></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="email" name="email" placeholder="Enter Your Email" required /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="pass" placeholder="Enter Your Password" required /></td>
            </tr>
            <tr>
                <td colspan="2" id="sb" class="btn">
                    <button type="submit" name="u_signup">Register</button>

                    <button>Reset</button>
                </td>


            </tr>
            <tr>
                <td colspan="2" class="">
                    <span style="color: blue; text-decoration: underline;"><a href="./../service provider/serviceProReg.php">Register
                            as
                            service holder </a>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="">

                    <span>Do you have any account? please <a href="./userLogin.php">login</a>
                    </span>
                    <?php
                    if (isset($regMsg)) {
                        echo $regMsg;
                    }
                    ;
                    ?>
                </td>
            </tr>

        </table>
    </form>
</section>