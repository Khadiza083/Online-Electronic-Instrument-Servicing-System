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

$sql = "SELECT * From user_request_tb WHERE request_id = {$_SESSION['myid']}";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='form'>
    <table>
        <tbody>
            <tr>
                <th align='left'>Request ID</th>
                <td>" . $row['request_id'] . "</td>
            </tr>
            <tr>
                <th align='left'>Name</th>
                <td>" . $row['req_name'] . "</td>
            </tr>
            <tr>
                <th align='left'>Email ID</th>
                <td>" . $row['req_email'] . "</td>
            </tr>
            <tr>
                <th align='left'>Request Info</th>
                <td>" . $row['req_info'] . "</td>
            </tr>
            <tr>
                <th align='left'>Request Description</th>
                <td>" . $row['req_desc'] . "</td>
            </tr>

                   
            <tr>
                <form>
                    <td colspan='2'>
                        <button type='submit' onClick='window.print()'>Print</button>
                    </td>
                    
                </form>
            </tr>
        </tbody>
        
    </table>
    
</div>";
} else {
    echo 'Failed';
}

include('./component/footer.php');
?>