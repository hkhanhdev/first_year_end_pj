<?php include_once ("master/database.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];
$get_total_price_sql = "select o.customer_id,u.username,u.email,SUM(o.ord_total_price) as total from tbl_order o left join tbl_user u on o.customer_id = u.user_id where u.username = '$username' and ord_status = 'in cart' group by o.customer_id;";
$result = mysqli_query($conn,$get_total_price_sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order payment</title>
    <link rel="stylesheet" href="assets/css/style_payment_page.css">
</head>
<body>

<div class="container">
    <form action="payment.php" method="post">
        <div class="row">
            <div class="col">
                <h3 class="title">Payment Information</h3>

                <div class="inputBox">
                    <span>Full name :</span>
                    <input type="text" placeholder="Enter your full name">
                </div>
                <div class="inputBox">
                    <span>E-mail :</span>
                    <input type="email" placeholder="example@gmail.com">
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" placeholder="Enter your address">
                </div>
                <div class="inputBox">
                    <span>Zip code :</span>
                    <input type="text" placeholder="Enter your zip code">
                </div>
                <div class="inputBox">
                    <span>Total : $<?php echo $row["total"] ?></span>
                </div>
            </div>

            <div class="col">
                <h3 class="title">Payment methods</h3>

                <div class="inputBox">
                    <span>Card samples :</span>
                    <img src="assets/images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Card Name :</span>
                    <input type="text" placeholder="Enter your card name">
                </div>
                <div class="inputBox">
                    <span>Card Number :</span>
                    <input type="text" placeholder="Enter your card number">
                </div>
                <div class="inputBox">
                    <span>Expired Day :</span>
                    <input type="text" placeholder="D/M/Y">
                </div>
                <div class="inputBox">
                    <span>CVC :</span>
                    <input type="text" placeholder="Enter your CVC code">
                </div>
            </div>
        </div>
        <input type="submit" value="Proceed payment" name="Proceed" class="submit-btn">
    </form>
</div>
    
</body>
</html>
<?php if (isset($_POST['Proceed'])) {
    $customer_id = $row['customer_id'];
    $update_status_query = "update tbl_order set ord_status = 'processing' where customer_id = '$customer_id' and ord_status = 'in cart'";
    $updated_query = mysqli_query($conn,$update_status_query);
    if ($updated_query) { ?>
        <script>
        alert("Your order is being processed!");
        window.location.href = 'index.php';
        </script>
<?php }} ?>
<?php $conn->close();?>