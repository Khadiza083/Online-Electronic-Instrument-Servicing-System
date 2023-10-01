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

if(isset($_POST['submit'])){
    $u_location = $_POST['location'];
    $_SESSION['u_location'] = $u_location;
    $sql = "SELECT * FROM s_provider_login WHERE s_p_district = '$u_location'";
    $result = $conn->query($sql);
    if($result == TRUE){
        echo "<script>location.href='./allSProvider.php'</script>";
    }
}

// ?>


<section style="display: grid;">
    <h1 class="title">Provide Your Location</h1>
    <form action="" method="POST" class="form">
        <input type="text" name="location" placeholder="Enter your location" style="width: 80%;" required ><br>
        <button name="submit" style="margin: 20px 0;">Submit</button>
    </form>
</section>
<!-- Main content -->
<!-- <div class="sub-reqs">
    <section>
        <form method="POST">
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
          
            <button type="submit" name="reqSubmit">Submit</button>
            <button type="submit" name="reset">Reset</button>
        </form>
    </section>
</div> -->
<?php
include('./component/footer.php')
    ?>