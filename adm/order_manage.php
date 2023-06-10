<?php include_once('topbar_sidebar.php');
include_once ('database.php'); ?>

<?php $sql = "select ord_id,customer_id,u.username,o.prd_id,p.prd_name,u.email,ord_amount,ord_buy_date,ord_total_price,ord_status,u.customer_message from tbl_order o left join tbl_user u on o.customer_id = u.user_id left join tbl_product p on o.prd_id = p.prd_id;";
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
            <th scope="col">User Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Buy Date</th>
            <th scope="col">Status</th>
            <th scope="col">Message</th>
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
                <td><?php echo $row['ord_status']?></td>
                <td><?php echo $row['customer_message']?></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteOrd(<?php echo $row['ord_id']?>)">Delete</button></td>
            </tr>
        <?php
    }
    if (isset($_POST['ord_id'])) {
        $ord_id = $_POST['ord_id'];
        $delete_clause = "DELETE FROM tbl_order WHERE ord_id = $ord_id";
        $is_deleted = mysqli_query($conn, $delete_clause);
        if ($is_deleted) {
            $update_clause = "UPDATE tbl_order SET ord_id = ord_id - 1 where ord_id > ".$ord_id;
            $resort_order = mysqli_multi_query($conn, $update_clause);
            if ($resort_order) {
            echo 'Order of prd_id updated successfully.';
            } else {
            echo 'Error updating order of prd_id: ' . mysqli_error($conn);
            }
        }
        else {
        echo 'Error executing SQL script: ' . mysqli_error($conn);
        }
    } }
    else {
    // Handle case when no rows are retrieved
    echo "<tr><td colspan='6'>No orders found.</td></tr>";
    }
?>

        </tbody>
    </table>
</div>
<script>
    function deleteOrd(ord_id) {
        // Make AJAX request to the PHP file
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        // Create a new FormData object and append the value to it
        var formData = new FormData();
        formData.append('ord_id', ord_id);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
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
