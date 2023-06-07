<?php include_once('topbar_sidebar.php');
include_once ('database.php'); ?>

<?php $sql = "select ord_id,customer_id,count(ord_amount) as so_luong_san_pham from tbl_order group by customer_id;";
$result = mysqli_query($conn,$sql);
?>
<div id="content">
    <h1 style="font-weight: bold">All orders</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer ID</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()) {?>
            <tr>
                <th scope="row"><?php echo $row['user_id']?></th>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['customer_message']?></td>
                <td><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>



<?php
$conn->close();
include_once ('footer.php')
?>
