<?php include_once('topbar_sidebar.php');
include_once ('database.php');
$sql = "select ord_id,customer_id,u.username,o.prd_id,p.prd_name,u.email,ord_amount,ord_buy_date,ord_total_price,ord_status from tbl_order o left join tbl_user u on o.customer_id = u.user_id left join tbl_product p on o.prd_id = p.prd_id;";
$result = mysqli_query($conn,$sql);

if (isset($_POST['ord_id']) and isset($_POST['status'])) {
    $ord_id = $_POST['ord_id'];
    $status = $_POST['status'];
    echo $ord_id;
    echo $status;
    $update_ord = "UPDATE tbl_order SET ord_status = '$status' where ord_id = '$ord_id'";
    $updated_ord = mysqli_query($conn, $update_ord);
}
?>
<div id="content">
    <h1 style="font-weight: bold">All orders</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer ID</th>
            <th scope="col">Email</th>
            <th scope="col">User Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Buy Date</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
<?php if ($result->num_rows > 0) {?>
<?php while($row = $result->fetch_assoc()) {?>
            <tr>
                <th scope="row"><?php echo $row['ord_id']?></th>
                <td><?php echo $row['customer_id']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['prd_name']?></td>
                <td><?php echo $row['ord_amount']?></td>
                <td><?php echo $row['ord_total_price']?></td>
                <td><?php echo $row['ord_buy_date']?></td>
<?php if ($row['ord_status'] == "in cart") { ?>
                <td class="table-primary"><?php echo $row['ord_status']?></td>
<?php }elseif($row['ord_status'] == "processing") { ?>
                <td class="table-info"><?php echo $row['ord_status']?></td>
<?php }elseif($row['ord_status'] == "delivered") { ?>
                <td class="table-success"><?php echo $row['ord_status']?></td>
<?php }elseif ($row['ord_status'] == "canceled") { ?>
                <td class="table-danger"><?php echo $row['ord_status']?></td>
<?php }?>
                <td><button type="button" class="btn btn-success" onclick="changeStateOrd(<?php echo $row['ord_id']?>,'delivered')">Confirm order</button></td>
                <td><button type="button" class="btn btn-danger" onclick="changeStateOrd(<?php echo $row['ord_id']?>,'canceled')">Cancel order</button></td>
            </tr>
<?php }}else {
    // Handle case when no rows are retrieved
    echo "<tr><td colspan='6'>No orders found.</td></tr>";
}?>
        </tbody>
    </table>
</div>
<script>
    function changeStateOrd(ord_id,status) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        var formData = new FormData();
        formData.append('ord_id', ord_id);
        formData.append('status', status);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert("Updating ...")
                window.location.href = "order_manage.php";
            }
        };
        xhr.send(formData);
    }
</script>

<?php
$conn->close();
include_once ('footer.php')
?>
