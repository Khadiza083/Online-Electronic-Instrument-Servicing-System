
<?php
define('TITLE', 'Profile');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_s_login']) {
    $s_Email =  $_SESSION['email'];
} else {
    echo "<script>location.href='./serviceProLogin.php'</script>";
}

$sql = "SELECT * FROM s_provider_login WHERE s_p_email = '$s_Email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $sName = $row['s_p_name'];
    $spass = $row['s_p_pass'];

}

// update name 
if (isset($_POST['update'])) {
    $sUpName = $_POST['updateName'];
    $sUpPass = $_POST['updatePass'];

    $sql = "UPDATE s_provider_login SET s_p_name='$sUpName', s_p_pass='$sUpPass' WHERE s_p_email = '$s_Email'";
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
                    <td>Your Name: </td>
                    <td><input type="text" name="updateName" value="<?php echo $sName; ?>" required> </td>
                </tr>
                <tr>
                    <td>Your Email: </td>
                    <td><input type="email" name="updateEmail" value="<?php echo $s_Email; ?>" readonly /></td>
                </tr>
                <tr>
                    <td>Change password: </td>
                    <td><input type="password" name="updatePass" value="<?php echo $spass; ?>" /></td>
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