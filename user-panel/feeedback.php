<?php
// title and active class
define('TITLE', 'Feedback');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_login']) {
    $uEmail = $_SESSION['email'];
} else {
    echo "<script>location.href='./../Homepage/userLogin.php'</script>";
}
$sql = "SELECT u_id, u_name, u_email FROM user_login WHERE u_email='$uEmail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$uName = $row['u_name'];

if (isset($_POST['reqSubmit'])) {
    $uCity = $_POST['city'];
    $uMsg = $_POST['feedback'];
    $sql = "INSERT INTO feedback_tb(u_name, u_email, u_city, u_msg) VALUES('$uName', '$uEmail', '$uCity', '$uMsg')";
    if($conn->query($sql) == TRUE){
        $msg = '<div style="background-color: #28a745; color:white ; margin: 10px 0; padding: 10px; border-radius: 5px;">Submitted Successfully</div>';
    }
    else {
        $msg = '<div style="background-color: #ffc107; color:white ; margin: 10px 0; padding: 10px; border-radius: 5px;">Not Submitted</div>';
    }
}
?>
<style>
    form {
        width: 60%;

        margin: 60px auto;
        padding: 20px 10px;

        box-shadow: 1px 2px 3px 4px rgba(241, 228, 228, 0.4);
        border-radius: 0 10px;
    }
</style>
<!-- Main content -->
<div class="sub-reqs">
    <section>
        <form method="POST">

            <div class="req">
                <div>
                    <label for="">Name</label>
                </div>
                <input type="text" placeholder="Name" name="name" value="<?php echo $uName;?>" required>
            </div>

            <div class="req">
                <div>
                    <label for="">City</label>
                </div>
                <input type="text" name="city" required>
            </div>
            <div class="req">

                <div>
                    <label for="">Email</label>
                </div>
                <input type="email" name="email" value="<?php echo $uEmail;?>" required>

            </div>
            <div class="req">

                <div>
                    <label for="">Write your feedback message</label>
                </div>
                <textarea name="feedback" id="" cols="50" rows="5" required></textarea>

            </div>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ;
            ?>
            <button type="submit" name="reqSubmit">Submit</button>

        </form>
    </section>
</div>
<?php
include('./component/footer.php')
    ?>