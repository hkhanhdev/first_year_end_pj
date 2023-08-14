<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once ('master/database.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LaptopShop cua Lâm Khánh</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>
<div class="header_section header_main">
    <div class="container-fluid">
        <nav class="navbar navbar-light  ">
            <a class="navbar-brand" href="./index.php"><img class="header_img" src="./assets/images/Lâm and Khánh (1).png"></a>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="./index.php">Home</a>
<?php
if (isset($_SESSION['username'])) {
$get_cart_items_query = "select count(ord_id) as so_san_pham from tbl_order o left join tbl_user u on o.customer_id = u.user_id where username = '".$_SESSION['username']."' and ord_status = 'in cart' ;";
$get_cart_items_result = mysqli_query($conn,$get_cart_items_query);
$hang = $get_cart_items_result->fetch_assoc();
$_SESSION['so_san_pham'] = $hang['so_san_pham'];
} else {
$_SESSION['so_san_pham'] = 0;
?>
                    <a href="./login.php">Login</a>
                    <a href="./signup.php">Sign up</a>
<?php } ?>

                <a href="./contact.php">Contact</a>
                <div class="header_icon">
                    <a href="cart.php"><i class="uil uil-shopping-cart"></i><span class="badge badge-warning navbar-badge"><?php echo $_SESSION['so_san_pham']?></span></a>
                    <a href="user.php">Account</a>
                </div>
            </div>
            <span style="font-size:30px;cursor:pointer; color: #fff;" onclick="openNav()"><img src="./assets/images/toggle-icon.png"></span>

        </nav>
    </div>
</div>


