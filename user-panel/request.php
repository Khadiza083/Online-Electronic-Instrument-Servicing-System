<?php
// title and active class
define('TITLE', 'Submit Request');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_login']) {
    $uEmail = $_SESSION['email'];
} else {
    echo "<script>location.href='./../Homepage/userLogin.php'</script>";
}
$s_email =  $_SESSION['s_email'] ;
if (isset($_POST['reqSubmit'])) {
    $reqInfo = $_POST['reqInfo'];
    $reqDes = $_POST['reqDes'];
    $reqName = $_POST['name'];
    $reqAdd1 = $_POST['add1'];
    $reqAdd2 = $_POST['add2'];
    $reqCity = $_POST['city'];
    $reqState = $_POST['state'];
    $reqEmail = $_POST['email'];
    $reqMobile = $_POST['mobile'];
    $reqDate = $_POST['date'];

    $sql = "INSERT INTO user_request_tb(s_p_email, req_info, req_desc, req_name, req_add1, req_add2, req_city, req_state, req_email, req_mobile, req_date) 
    VALUES('$s_email','$reqInfo', '$reqDes', '$reqName', '$reqAdd1', '$reqAdd2', '$reqCity', '$reqState', '$reqEmail', '$reqMobile', '$reqDate')";
    if ($conn->query($sql) == TRUE) {
        $genId = mysqli_insert_id($conn);
        $Msg = '<div style="background-color: green; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Submitted successfully</div>';
        $_SESSION['myid'] = $genId;
        echo "<script>location.href='./success.php'</script>";
    } else {
        $Msg = '<div style="background-color: red; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Unable to Submit</div>';
    }

}
?>

<!-- Main content -->
<div class="sub-reqs">
    <section>
        <form method="POST">
            <div class="req">
                <div>
                    <label for="">Service Provider Email</label>
                </div>
                <input type="text" placeholder="" name="s_email" value="<?php echo $s_email; ?>"  readonly>
            </div>
            <div class="req">
                <div>
                    <label for="">Request Info</label>
                </div>
                <input type="text" placeholder="Request Info" name="reqInfo" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Description</label>
                </div>
                <input type="text" name="reqDes" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Name</label>
                </div>
                <input type="text" placeholder="Name" name="name" required>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Address Line 1</label>
                    </div>
                    <input type="text" name="add1" required>
                </div>
                <div>
                    <div>
                        <label for="">Address Line 2</label>
                    </div>
                    <input type="text" name="add2" required>
                </div>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">City</label>
                    </div>
                    <input type="text" name="city" required>
                </div>
                <div>
                    <div>

                    <label for="">State</label>
                    </div>
                    <input type="text" name="state" required>

                </div>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Email</label>
                    </div>
                    <input type="email" name="email" required>
                </div>
                <div class="req-flex">
                    <div>
                        <div>
                            <label for="">Mobile</label>
                        </div>
                        <input type="number" name="mobile" required>
                    </div>
                    <div>
                        <div>
                            <label for="">Date</label>
                        </div>
                        <input type="date" name="date" required>
                    </div>
                </div>
            </div>
            <?php
                    if (isset($Msg)) {
                        echo $Msg;
                    }
                    ;
                    ?>
            <button type="submit" name="reqSubmit">Submit</button>
           
        </form>
    </section>
    <button type="submit" name="back" ><a href="allSProvider.php">Back</a></button>
</div>
<?php
include('./component/footer.php')
    ?>