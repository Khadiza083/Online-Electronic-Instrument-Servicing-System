<?php
// title and active class
define('TITLE', 'Confirmed Order');
include('./component/header.php');
include('./../Homepage/dbConnection.php');

if ($_SESSION['is_s_login']) {
    $s_Email =  $_SESSION['email'];
} else {
    echo "<script>location.href='./serviceProLogin.php'</script>";
}

?>

<div class="cards">

    <?php
    $sql = "SELECT * FROM confirm_order_tb WHERE s_p_email='$s_Email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="con-card">';
            echo '<div class="head">';
            echo '<h4>Request Id: ' . $row['request_id'] . '</h4>';
            echo '</div>';
            echo '<div class="con-content">';
            echo '<h4>Request Info: ' . $row['req_info'] . '</h4>';
            echo '<p>Delivery Date:' . $row['req_date'] . '</p>';
            echo '<p>Service Provider Email:' . $row['s_p_email'] . '</p>';
            echo '</div>';

            echo '</div>';
        }
    }
    ?>

</div>


<?php
    include('./component/footer.php')
?>