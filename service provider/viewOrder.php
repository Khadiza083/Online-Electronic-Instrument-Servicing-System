<?php
// title and active class
define('TITLE', 'View Order');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_s_login']) {
    $s_Email =  $_SESSION['email'];
} else {
    echo "<script>location.href='./serviceProLogin.php'</script>";
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
        display: flex;
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
       
        $sql = "SELECT * FROM work_order_tb WHERE r_s_email = '$s_Email'" ;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="con-card">';
                echo '<div class="head">';
                echo '<h4>Request Id: ' . $row['r_no'] . '</h4>';
                echo '</div>';
                echo '<div class="con-content">';
                echo '<h4>Request Info: ' . $row['r_info'] . '</h4>';
                echo '<p>Description:' . $row['r_desc'] . '</p>';
                echo '<p>Request Date:' . $row['r_date'] . '</p>';
                echo '</div>';
                echo '<form method="POST" class="button">';
                echo '<input type="hidden" name="id" value=' . $row['r_no'] . '>';
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
            $sql = "SELECT * FROM work_order_tb WHERE r_no = {$_POST['id']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }
        if (isset($_POST['close'])) {
            $sql = "DELETE FROM work_order_tb WHERE request_id = {$_POST['id']}";
            if ($conn->query($sql) == TRUE) {
                echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
            } else {
                echo 'unable to delete';
            }

        }


        // assign work button
        
        if (isset($_POST['confirm'])) {
            $userId = $_POST['userId'];
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
            $reqId = $_POST['reqId'];

    
            // s_p_email 	req_info 	req_desc 	req_name 	req_add1 	req_add2 	req_city 	req_zip 	req_state 	req_email 	req_mobile 	req_date
            $sql = "INSERT INTO confirm_order_tb(request_id, s_p_email, req_info, req_desc,  req_name, 	req_add1, 	req_add2, 	req_city, 	req_state, 	req_email, 	req_mobile, req_date) VALUES('$userId', '$s_Email', '$reqInfo', '$reqDes', '$reqName', '$reqAdd1', '$reqAdd2', '$reqCity', '$reqState', '$reqEmail', '$reqMobile', '$reqDate')";


            if ($conn->query($sql) == TRUE) {
                $sql = "DELETE FROM work_order_tb WHERE r_no = '$reqId'";
                if ($conn->query($sql) == TRUE) {
                    echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
                }
                $Msg = '<div style="background-color: green; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Confirmed successfully</div>';
            } else {
                $Msg = '<div style="background-color: red; color:white ; text-align: center; margin-top: 10px; margin-bottom:10px;">Unable to Submit</div>';
            }
        }
        ?>
        <!-- r_no 	request_id 	r_info 	r_desc 	r_name 	r_add1 	r_add2 	r_city 	r_state 	r_email 	r_mobile 	r_date 	r_s_email -->
        <form method="POST">
            <h1>Confirm User Request</h1>
            <div class="req">
                <div>
                    <label for="">Request Id</label>
                </div>
                <input type="text" name="reqId" value="<?php if (isset($row['r_no'])) {
                    echo $row['r_no'];
                } ?>" readonly>
            </div>
            <div class="req">
                <div>
                    <label for="">User Id</label>
                </div>
                <input type="text" name="userId" value="<?php if (isset($row['request_id'])) {
                    echo $row['request_id'];
                } ?>" readonly>
            </div>
            <div class="req">
                <div>
                    <label for="">Request Info</label>
                </div>
                <input type="text" placeholder="Request Info" name="reqInfo" value="<?php if (isset($row['r_info'])) {
                    echo $row['r_info'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Description</label>
                </div>
                <input type="text" name="reqDes" value="<?php if (isset($row['r_desc'])) {
                    echo $row['r_desc'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Name</label>
                </div>
                <input type="text" placeholder="Name" name="name" value="<?php if (isset($row['r_name'])) {
                    echo $row['r_name'];
                } ?>" required>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Address Line 1</label>
                    </div>
                    <input type="text" name="add1" value="<?php if (isset($row['r_add1'])) {
                        echo $row['r_add1'];
                    } ?>" required>
                </div>
                <div>
                    <div>
                        <label for="">Address Line 2</label>
                    </div>
                    <input type="text" name="add2" value="<?php if (isset($row['r_add2'])) {
                        echo $row['r_add2'];
                    } ?>" required>
                </div>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">City</label>
                    </div>
                    <input type="text" name="city" value="<?php if (isset($row['r_city'])) {
                        echo $row['r_city'];
                    } ?>" required>
                </div>
                <div>
                    <div>

                        <label for="">State</label>
                    </div>
                    <input type="text" name="state" value="<?php if (isset($row['r_state'])) {
                        echo $row['r_state'];
                    } ?>" required>

                </div>
            </div>
            <div class="req">
                <div>
                    <label for="">Email</label>
                </div>
                <input type="email" name="email" value="<?php if (isset($row['r_email'])) {
                    echo $row['r_email'];
                } ?>" required>

            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Mobile</label>
                    </div>
                    <input type="number" name="mobile" value="<?php if (isset($row['r_mobile'])) {
                        echo $row['r_mobile'];
                    } ?>" required>
                </div>
                <div>
                    <div>
                        <label for="">Date</label>
                    </div>
                    <input type="date" name="date" required>
                </div>
            </div>
            
            <?php
            if (isset($Msg)) {
                echo $Msg;
            }
            ;
            ?>
            <button type="submit" name="confirm">Confirm</button>
            <button type="submit" name="reset">Reset</button>
        </form>
    </div>
</section>


<?php
include('./component/footer.php')
?>