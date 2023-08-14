<?php include_once ('master/header.php'); ?>
<?php
include_once ('master/database.php');
if ($_SESSION['username'] == '') {
    $message = "Please logging in to view your account";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location:login.php');
}else { ?>
    <h1>Welcome,<?php echo $_SESSION['username'];?></h1>
    <div>
    <h3>User Information</h3>
    <hr>
    <p><strong>Username:<?php echo $_SESSION['username'];?></strong> </p>
    <p><strong>Email:<?php echo $_SESSION['email'];?></strong> </p>
    <p><strong>Products in Cart:<?php echo $_SESSION['so_san_pham']?></strong></p>
    </div>

<?php
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<form id="logoutForm" method="post" action="user.php">
    <button type="submit" name="logout">Logout</button>
</form>
<?php
$conn->close();
include_once ('master/footer.php');
?>
