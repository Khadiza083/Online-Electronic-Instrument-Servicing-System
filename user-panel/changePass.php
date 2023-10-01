
<?php
define('TITLE', 'Change Password');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_login']) {
    $uEmail = $_SESSION['email'];
} else {
    echo "<script>location.href='./../Homepage/userLogin.php'</script>";
}

$sql = "SELECT  u_pass, u_email FROM user_login WHERE u_email = '$uEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $uPass = $row['u_pass'];
}

// update name 
if (isset($_POST['update'])) {
    $uPass = $_POST['updatePass'];

    $sql = "UPDATE user_login SET u_pass='$uPass' WHERE u_email = '$uEmail'";
    if ($conn->query($sql) == TRUE) {
        $passMsg = '<div style="background-color: #28a745; color:white ; margin: 10px 0; padding: 10px; border-radius: 5px;">Updated Successfully</div>';
    } else {
        $passMsg = '<div style="background-color: #ffc107; color:white ; margin: 10px 0; padding: 10px; border-radius: 5px;">unable to update</div>';
    }
}
?>

<!-- update Profile -->
<div class="up-pro">
    <section class="form">
        <form method="POST">
            <table>
                
                <tr>
                    <td>Your Email: </td>
                    <td><input type="email" name="updateEmail" value="<?php echo $uEmail; ?>" readonly /></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="updatePass" value="<?php echo $uPass; ?>" required> </td>
                </tr>
                <tr>
                    <td colspan="2" id="sb" class="btn">
                        <button type="submit" name="update">Update</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        if (isset($passMsg)) {
                            echo $passMsg;
                        }
                        ;
                        ?>

                    </td>
                </tr>
            </table>
        </form>
    </section>
</div>
<?php
    include('./component/footer.php');
?>