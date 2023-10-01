<?php
define('TITLE', 'Manage Service Providers');
include('./component/header.php');
include('./../Homepage/dbConnection.php');
session_start();
if ($_SESSION['is_admin_login']) {
    $admin_Email = $_SESSION['admin_email'];
} else {
    echo "<script>location.href='./login.php'</script>";
}

?>

<style>
    /* cards area */
    * {
        margin: 0;
    }

    .confirm-area {
        width: 100%;
        margin: 15px 0;
    }

    #cards {
        width: 33%;
    }

    .con-card {
        border: 1px solid #dad9d9;
        width: 100%;
        margin-bottom: 20px
    }

    .con-card .head {
        background-color: #f1eded;
        color: #777777;
        padding: 10px 5px;
    }

    .con-content {
        padding: 5px;
    }

    .con-content h4 {
        margin: 10px 0;
    }

    .con-content p {
        color: #727171;
        margin: 10px 0;
    }

    .button {
        text-align: right;

    }

    .button button {
        border-radius: 0;
    }

    .close {
        background-color: #777777;
        margin-left: 10px;
    }

    /* form area */
    .form-area {
        width: 60%;
        margin-left: 30px;
    }

    .form-area h1 {
        text-align: center;
        color: #ed04f5;
        font-size: 30px;
        margin: 10px 0;
    }

    .sub-reqs {
        margin: 20px;
    }

    .req {
        margin-bottom: 10px;
    }

    .req div {
        margin-bottom: 5px;
        font-size: 18px;

    }

    .req-flex {
        display: flex;
        gap: 7px;
    }

    .req-flex div {
        margin: 0;
        width: 47%;
    }

    input {
        width: 90%;
        padding: 10px;
    }
</style>

<section class="confirm-area">

    <!-- this is the cards area -->
    <div id="cards">

        <?php

        $sql = "SELECT * FROM s_provider_reg ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="con-card">';
                echo '<div class="head">';
                echo '<h4>Request Id: ' . $row['s_p_id'] . '</h4>';
                echo '</div>';
                echo '<div class="con-content">';
                echo '<h4>Service Provider Name: ' . $row['s_p_name'] . '</h4>';
                echo '<p>Email:' . $row['s_p_email'] . '</p>';
                echo '<p>Servicing Centre Name:' . $row['s_p_servicingcentre'] . '</p>';
                echo '</div>';
                echo '<form method="POST" class="button">';
                echo '<input type="hidden" name="id" value=' . $row['s_p_id'] . '>';
                echo '<button type="submit" name="view" class="view">View</button>';
                echo '<button class="close" type="submit" name="close">Reject</button>';
                echo '</form>';
                echo '</div>';
            }
        }
        ?>

    </div>
    <!-- this is the confirm form area -->
    <div class="form-area">

        <?php

        if (isset($_POST['view'])) {
            $sql = "SELECT * FROM s_provider_reg WHERE s_p_id = {$_POST['id']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
        if (isset($_POST['close'])) {
            $sql = "DELETE FROM s_provider_reg WHERE s_p_id = {$_POST['id']}";
            if ($conn->query($sql) == TRUE) {
                echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
            } else {
                $Msg = 'unable to delete';
            }

        }


        // assign work button
        
        if (isset($_POST['accept'])) {
            $id = $_POST['reqId'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $s_name = $_POST['s_name'];
            $services = $_POST['services'];
            $district = $_POST['district'];
            $mobile = $_POST['mobile'];

            //  s_p_id 	s_p_name 	s_p_email 	s_p_pass 	s_p_servicingcentre 	s_p_services 	s_p_district 	s_p_mobile	
            $sql = "INSERT INTO s_provider_login(s_p_id, s_p_name, s_p_email,  s_p_pass, s_p_servicingcentre, s_p_services, s_p_district, s_p_mobile) VALUES('$id', '$name', '$email', '$pass', '$s_name', '$services', '$district', '$mobile')";


            if ($conn->query($sql) == TRUE) {
                $sql = "DELETE FROM s_provider_reg WHERE s_p_id = $id";
                if ($conn->query($sql) == TRUE) {
                    echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
                }
                $Msg = '<div style="background-color: green; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Confirmed successfully</div>';
            } else {
                $Msg = '<div style="background-color: red; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Unable to Submit</div>';
            }
        }
        ?>
        <form method="POST">
            <h1>Accept Service Provider Request</h1>
            <div class="req">
                <div>
                    <label for="">ID</label>
                </div>
                <input type="text" name="reqId" value="<?php if (isset($row['s_p_id'])) {
                    echo $row['s_p_id'];
                } ?>" readonly>
            </div>
            <div class="req">
                <div>
                    <label for="">Service Provider Name</label>
                </div>
                <input type="text" placeholder="Name" name="name" value="<?php if (isset($row['s_p_name'])) {
                    echo $row['s_p_name'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Email</label>
                </div>
                <input type="text" name="email" value="<?php if (isset($row['s_p_email'])) {
                    echo $row['s_p_email'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Password</label>
                </div>
                <input type="text" placeholder="password" name="pass" value="<?php if (isset($row['s_p_pass'])) {
                    echo $row['s_p_pass'];
                } ?>" required>
            </div>


            <div class="req">
                <div>
                    <label for="">Servicing Centre Name</label>
                </div>
                <input type="text" name="s_name" value="<?php if (isset($row['s_p_servicingcentre'])) {
                    echo $row['s_p_servicingcentre'];
                } ?>" required>

            </div>
            <div class="req">
                <div>
                    <label for="">Services</label>
                </div>
                <input type="text" name="services" value="<?php if (isset($row['s_p_services'])) {
                    echo $row['s_p_services'];
                } ?>" required>

            </div>
            <div class="req">
                <div>
                    <label for="">District</label>
                </div>
                <input type="text" name="district" value="<?php if (isset($row['s_p_district'])) {
                    echo $row['s_p_district'];
                } ?>" required>

            </div>
            <div class="req">
                <div>
                    <label for="">Mobile no.</label>
                </div>
                <input type="number" name="mobile" value="<?php if (isset($row['s_p_mobile'])) {
                    echo $row['s_p_mobile'];
                } ?>" required>

            </div>

            <?php
            if (isset($Msg)) {
                echo $Msg;
            }
            ;
            ?>
            <button type="submit" name="accept">Accept</button>

        </form>
    </div>
</section>


<?php
include('./component/footer.php');
?>