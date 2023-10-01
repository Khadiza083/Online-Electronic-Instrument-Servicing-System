<?php
define('TITLE', 'Dashboard');
include('./component/header.php');
include('./../Homepage/dbConnection.php');
session_start();
if ($_SESSION['is_admin_login']) {
    $admin_Email = $_SESSION['admin_email'];
} else {
    echo "<script>location.href='./login.php'</script>";
}

if (isset($_POST['delete'])) {
    $u_id = $_POST['id'];
    $sql = "DELETE FROM user_login WHERE u_id = $u_id";
    if ($conn->query($sql) == TRUE) {
        echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
    }
}
?>

<section>
    <div class="card">
        <h4>No of Completed Order</h4>
        <?php

        $sql = "select * from confirm_order_tb";
        $sql_run = mysqli_query($conn, $sql);

        if ($total = mysqli_num_rows($sql_run)) {
            echo '<h4 class="mb_0"> ' . $total . ' </h4>';
        } else {
            echo '<h4 class="mb_0"> No Data </h4>';
        }
        ?>
        <button class="delete-btn"><a href="completed.php">View</a></button>
    </div>
    <div class="card">
        <h4>No of Received Request</h4>
        <?php

        $sql = "select * from user_request_tb";
        $sql_run = mysqli_query($conn, $sql);

        if ($total = mysqli_num_rows($sql_run)) {
            echo '<h4 class="mb_0"> ' . $total . ' </h4>';
        } else {
            echo '<h4 class="mb_0"> No Data </h4>';
        }
        ?>
        <button class="delete-btn"><a href="confirm.php">View</a></button>
    </div>
    <div class="card">
        <h4>No. of Service Providers</h4>
        <?php

        $sql = "select * from s_provider_login";
        $sql_run = mysqli_query($conn, $sql);

        if ($total = mysqli_num_rows($sql_run)) {
            echo '<h4 class="mb_0"> ' . $total . ' </h4>';
        } else {
            echo '<h4 class="mb_0"> No Data </h4>';
        }

        
        ?>
        <button class="delete-btn">View</button>
    </div>

</section>

<div class="user-list" id="users">
    <h3>List of Users</h3>

    <?php
    $sql = "SELECT * FROM user_login";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '
        <table>
            <thead class="border-bottom">
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr class="border-bottom">';
            echo '<td>' . $row['u_id'] . '</td>';
            echo '<td>' . $row['u_name'] . '</td>';
            echo '<td>' . $row['u_email'] . '</td>';
            echo '<td>
                <form method="POST">
                   
                    <input type="hidden" name="id" value=' . $row['u_id'] . '>
                    <button name="delete" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                </form>
                </td>';
            echo '</tr>';
        }
        echo '</tbody>

    </table>
        ';
    } else {
        echo "Failed";
    }
    ?>

</div>

<?php
include('./component/footer.php')
    ?>