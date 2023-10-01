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

$u_location = $_SESSION['u_location'];

$sql = "SELECT * FROM s_provider_login WHERE s_p_district = '$u_location'";

$result = $conn->query($sql);


if($result == TRUE){
    echo '
    <table style="margin-top: 30px;">
    <thead class="border-bottom">
        <th>Service Provider Name</th>
        <th>Email</th>
        <th>Able to Service</th>
        <th>Phone number</th>
        <th>Select</th>
    </thead>
    <tbody>';
    while($row = $result->fetch_assoc()){
        echo '<tr class="border-bottom">';
        echo '<td>'.$row['s_p_name'].'</td>';
        echo '<td>'.$row['s_p_email'].'</td>';
        echo '<td>'.$row['s_p_services'].'</td>';
        echo '<td>'.$row['s_p_mobile'].'</td>';
        echo '<td><form method="POST">
            <input type="hidden" name="id" value='.$row['s_p_id'].'>
            <button name="select">Select</button>
        </form></td>';
        echo '</tr>';
    }        
echo  '</tbody>

</table>
    
    ';
}

if(isset($_POST['select'])){
    $id = $_POST['id'];
    echo $id;
    $sql = "SELECT s_p_email FROM s_provider_login WHERE s_p_id = '$id'";
    $result = $conn->query($sql);
    $row =  $result->fetch_assoc();
    $_SESSION['s_email'] = $row['s_p_email'];
    

    echo "<script>location.href='./request.php'</script>";

}
?>