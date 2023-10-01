<?php
define('TITLE', 'Confirm Order');
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
        $sql = "SELECT request_id, req_info, req_desc, req_date FROM user_request_tb ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="con-card">';
                echo '<div class="head">';
                echo '<h4>Request Id: ' . $row['request_id'] . '</h4>';
                echo '</div>';
                echo '<div class="con-content">';
                echo '<h4>Request Info: ' . $row['req_info'] . '</h4>';
                echo '<p>Description:' . $row['req_desc'] . '</p>';
                echo '<p>Request Date:' . $row['req_date'] . '</p>';
                echo '</div>';
                echo '<form method="POST" class="button">';
                echo '<input type="hidden" name="id" value=' . $row['request_id'] . '>';
                echo '<button type="submit" name="view" class="view">View</button>';
                
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
            $sql = "SELECT * FROM user_request_tb WHERE request_id = {$_POST['id']}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
         
        }
        if (isset($_POST['reject'])) {
           // r_info 	r_desc 	r_name 	r_add1 	r_add2 	r_city 	r_state 	r_email 	r_mobile 	r_date 	r_s_email 
            $reqId = $_POST['reqId'];
            $reqInfo = $_POST['reqInfo'];
            $reqAdd1 = $_POST['add1'];
            $reqCity = $_POST['city'];
            $reqEmail = $_POST['email'];
            $reqMobile = $_POST['mobile'];
            $reqSEmail = $_POST['s_email'];

            $sql = "INSERT INTO rejected_tb(request_id, req_info, req_add1, req_city,req_email, req_mobile, s_p_email ) VALUES('$reqId', '$reqInfo', '$reqAdd1', '$reqCity', '$reqEmail', '$reqMobile', '$reqSEmail')";
            $result = $conn->query($sql);

            $sql = "DELETE FROM user_request_tb WHERE request_id = '$reqId'";
            if ($conn->query($sql) == TRUE) {
                echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
            } else {
                echo 'unable to delete';
            }
            

        }


        // assign work button
        
        if (isset($_POST['confirm'])) {
            $reqId = $_POST['reqId'];
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
            $reqSEmail = $_POST['s_email'];

            // r_info 	r_desc 	r_name 	r_add1 	r_add2 	r_city 	r_state 	r_email 	r_mobile 	r_date 	r_s_email 
            $sql = "INSERT INTO work_order_tb(request_id, r_info, r_desc,  r_name, r_add1, r_add2, r_city, r_state, r_email, r_mobile, r_date, r_s_email) VALUES('$reqId', '$reqInfo', '$reqDes', '$reqName', '$reqAdd1', '$reqAdd2', '$reqCity', '$reqState', '$reqEmail', '$reqMobile', '$reqDate', '$reqSEmail')";


            if ($conn->query($sql) == TRUE) {
                $sql = "DELETE FROM user_request_tb WHERE request_id = $reqId";
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
            <h1>Confirm User Request</h1>
            <div class="req">
                <div>
                    <label for="">Request Id</label>
                </div>
                <input type="text" name="reqId" value="<?php if (isset($row['request_id'])) {
                    echo $row['request_id'];
                } ?>" readonly>
            </div>
            <div class="req">
                <div>
                    <label for="">Request Info</label>
                </div>
                <input type="text" placeholder="Request Info" name="reqInfo" value="<?php if (isset($row['req_info'])) {
                    echo $row['req_info'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Description</label>
                </div>
                <input type="text" name="reqDes" value="<?php if (isset($row['req_desc'])) {
                    echo $row['req_desc'];
                } ?>" required>
            </div>
            <div class="req">
                <div>
                    <label for="">Name</label>
                </div>
                <input type="text" placeholder="Name" name="name" value="<?php if (isset($row['req_name'])) {
                    echo $row['req_name'];
                } ?>" required>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Address Line 1</label>
                    </div>
                    <input type="text" name="add1" value="<?php if (isset($row['req_add1'])) {
                        echo $row['req_add1'];
                    } ?>" required>
                </div>
                <div>
                    <div>
                        <label for="">Address Line 2</label>
                    </div>
                    <input type="text" name="add2" value="<?php if (isset($row['req_add2'])) {
                        echo $row['req_add2'];
                    } ?>" required>
                </div>
            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">City</label>
                    </div>
                    <input type="text" name="city" value="<?php if (isset($row['req_city'])) {
                        echo $row['req_city'];
                    } ?>" required>
                </div>
                <div>
                    <div>

                        <label for="">State</label>
                    </div>
                    <input type="text" name="state" value="<?php if (isset($row['req_state'])) {
                        echo $row['req_state'];
                    } ?>" required>

                </div>
            </div>
            <div class="req">
                <div>
                    <label for="">Email</label>
                </div>
                <input type="email" name="email" value="<?php if (isset($row['req_email'])) {
                    echo $row['req_email'];
                } ?>" required>

            </div>
            <div class="req req-flex">
                <div>
                    <div>
                        <label for="">Mobile</label>
                    </div>
                    <input type="number" name="mobile" value="<?php if (isset($row['req_mobile'])) {
                        echo $row['req_mobile'];
                    } ?>" required>
                </div>
                <div>
                    <div>
                        <label for="">Date</label>
                    </div>
                    <input type="date" name="date" required>
                </div>
            </div>
            <div class="req">
                <div>
                    <label for="">Service Provider Email</label>
                </div>
                <input type="text" placeholder="Service Provider Email" name="s_email" value="<?php if (isset($row['s_p_email'])) {
                        echo $row['s_p_email'];
                    } ?>" required>
            </div>
            <?php
            if (isset($Msg)) {
                echo $Msg;
            }
            ;
            ?>
            <button type="submit" name="confirm">Confirm</button>
            <button type="submit" name="reject">Reject</button>
        </form>
    </div>
</section>


<?php
include('./component/footer.php');
?>