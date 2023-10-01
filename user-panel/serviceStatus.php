<?php
// title and active class
define('TITLE', 'Service Status');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_login']) {
    $uEmail = $_SESSION['email'];
} else {
    echo "<script>location.href='./../Homepage/userLogin.php'</script>";
}
?>
<div class="user-list">
    <h3>Request Status</h3>

    <?php
    // Query for 'rejected_tb' data
    $sql_rejected = "SELECT request_id, req_info, s_p_email
                FROM rejected_tb
                WHERE req_email = '$uEmail'";

    $result_rejected = $conn->query($sql_rejected);

    // Query for 'confirm_order_tb' data
    $sql_confirmed = "SELECT request_id, req_info, s_p_email
                FROM confirm_order_tb
                WHERE req_email = '$uEmail'";

    $result_confirmed = $conn->query($sql_confirmed);

    $sql_pending = "SELECT request_id, r_info, r_s_email
                FROM work_order_tb
                WHERE r_email = '$uEmail'";

    $result_pending = $conn->query($sql_pending);

    if ($result_rejected->num_rows > 0 || $result_confirmed->num_rows > 0 || $result_pending->num_rows > 0 ) {
        echo '
    <table>
        <thead class="border-bottom">
            <th>Request ID</th>
            <th>Request Info</th>
            <th>Service Provider Email</th>
            <th>Status</th>
        </thead>
        <tbody>';

        
        function displayRow($row, $status)
        {
            echo '<tr class="border-bottom">';
            echo '<td>' . $row['request_id'] . '</td>';
            echo '<td>' . $row['req_info'] . '</td>';

            if ($row['s_p_email'] == '') {
                echo '<td>Not Available</td>';
            } else {
                echo '<td>' . $row['s_p_email'] . '</td>';
            }

            echo '<td>' . $status . '</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        function displayRow2($row, $status)
        {
            echo '<tr class="border-bottom">';
            echo '<td>' . $row['request_id'] . '</td>';
            echo '<td>' . $row['r_info'] . '</td>';

            if ($row['r_s_email'] == '') {
                echo '<td>Not selected</td>';
            } else {
                echo '<td>' . $row['r_s_email'] . '</td>';
            }

            echo '<td>' . $status .'</td>';
            echo '<td></td>';
            echo '</tr>';
        }

        // Display 'rejected_tb' rows with 'Not accepted' status
        while ($row = $result_rejected->fetch_assoc()) {
            displayRow($row, 'Sorry! We cannot help you.');
        }

        // Display 'confirm_order_tb' rows with 'Completed' status
        while ($row = $result_confirmed->fetch_assoc()) {
            displayRow($row, 'Congratulations! Your problem is solved.');
        }
        while ($row = $result_pending->fetch_assoc()) {
            displayRow2($row, 'Pending---');
        }

        echo '</tbody></table>';
    } else {
        echo "No records found";
    }
    ?>



</div>
<?php
include('./component/footer.php')
    ?>