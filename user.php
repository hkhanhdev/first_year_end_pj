<?php include_once ('master/header.php'); ?>

<?php
include_once ('master/database.php');
$sql = "select customer_id,count(ord_amount) as so_luong_san_pham from tbl_order where ord_status = 'in cart' group by customer_id;";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();
if ($result->num_rows == 0) {
    $_SESSION['number_of_products'] = 0;
}else {
    $_SESSION['number_of_products'] = $row['so_luong_san_pham'] ;
}
if ($_SESSION['username'] == '') {
    header('Location:login.php');
}else {
    echo "<h1>Welcome,".$_SESSION['username']."</h1>";
    echo "<div>";
    echo "<h3>User Information</h3>";
    echo "<p><strong>Username:".$_SESSION['username']."</strong> </p>";
    echo "<p><strong>Email:".$_SESSION['email']."</strong> </p>";
    echo "<p><strong>Products in Cart:".$_SESSION['number_of_products']."</strong></p>";
    echo "</div>";
    echo "</body>";
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


$conn->close();
?>
<form id="logoutForm" method="post" action="user.php">
    <button type="submit" name="logout">Logout</button>
</form>


<?php
include_once ('master/footer.php');
?>
