<?php include_once ("master/header.php");
include_once ("master/database.php"); ?>
<?php
if (!isset($_SESSION['username'])) { ?>
    <script>
        alert("Please log in to proceed any further process");
        window.location.href = 'login.php';
    </script>
<?php
}else { ?>
    <h2>Shopping Cart(<?php echo $_SESSION['username']?>)</h2>
<?php
if (isset($_POST['ord_id'])) {
    $ord_no = $_POST['ord_id'];
    $delete_ord = "DELETE FROM tbl_order WHERE ord_id = ".$ord_no;
    $deleted_ord = mysqli_query($conn, $delete_ord);
    if ($deleted_ord) {
        $update_ord = "UPDATE tbl_order SET ord_id = ord_id - 1 where ord_id > ".$ord_no;
        $reorder_ord = mysqli_multi_query($conn, $update_ord);

    }
    else {
        echo 'Error executing SQL script: ' . mysqli_error($conn);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int)$_POST['prd_id'];
    $productName = (string)$_POST['prd_name'];
    $productPrice = (int)$_POST['total_price'];
    $quantity = (int)$_POST['quantity'];
    $current_user_email = $_SESSION['email'];
    $get_email_query = "select user_id,email from tbl_user where email = '$current_user_email'";
    $get_email_result = mysqli_query($conn,$get_email_query);
    $row = $get_email_result->fetch_assoc();
    $cus_id = $row['user_id'];
    $insert_order_query = "insert into tbl_order(customer_id,prd_id,ord_amount,ord_buy_date,ord_total_price,ord_status) values($cus_id,$productId,$quantity,curdate(),$productPrice,'in cart')";
    $insert_order_result = mysqli_query($conn,$insert_order_query);


}
$get_order_query = "select ord_id,u.username,p.prd_name,ord_amount,ord_total_price,ord_status from tbl_order o left join tbl_user u on o.customer_id = u.user_id left join tbl_product p on o.prd_id = p.prd_id where u.username = '".$_SESSION['username']."' and ord_status = 'in cart';";
$get_order_result = mysqli_query($conn, $get_order_query);



    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
<?php if ($get_order_result->num_rows > 0) { $ord_number = 1;  ?>
    <?php while ($row = $get_order_result->fetch_assoc()) {?>
        <tr>
            <th scope="row"><?php echo $ord_number?></th>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['prd_name']?></td>
            <td><?php echo $row['ord_amount']?></td>
            <td>$<?php echo $row['ord_total_price']?></td>
            <td><button class="btn btn-outline-danger" onclick="delete_ord(<?php echo $row['ord_id']?>)">Delete</button></td>
        </tr><?php $ord_number += 1;?>
    <?php } }else {
    // Handle case when no rows are retrieved
    echo "<tr><td colspan='6'>No orders found.</td></tr>";
}
}
?>
        </tbody>
    </table>

<script>
    function delete_ord(ord_id) {
        // Make AJAX request to the PHP file
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        // Create a new FormData object and append the value to it
        var formData = new FormData();
        formData.append('ord_id', ord_id);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                window.location.href = "cart.php";
            }
        };
        xhr.send(formData);
    }
</script>
<?php
$conn->close();
include_once ("master/footer.php");
?>
