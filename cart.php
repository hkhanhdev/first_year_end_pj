<?php include_once ("master/header.php");
include_once ("master/database.php"); ?>

<?php
if ($_SESSION['username'] == '') {
    header('Location:login.php');
}else {
    $prd_name = $_GET['prd_name'];
    $prd_id = $_GET['prd_id'];
    $prd_price = $_GET['prd_price'];
    $prd_quantity = $_GET['quantity'];
    $current_user_email = $_SESSION['email'];

    $sql = "select user_id,email from tbl_user where email = '$current_user_email'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $cus_id = $row['user_id'];
    $sql = "insert into tbl_order(customer_id,prd_id,ord_amount,ord_total_price) values ($cus_id,$prd_id,$prd_quantity,$prd_price)";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            // Insertion successful
            echo "Insertion successful!";
        } else {
            // No rows affected
            echo "No rows affected. Insertion may not have been successful.";
        }
    } else {
        // Error occurred during the query
        echo "Error: " . mysqli_error($conn);
    }


}


$conn->close();
?>
<?php include_once ("master/footer.php")?>
