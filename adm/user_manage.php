<?php include_once('topbar_sidebar.php');
include_once ('database.php'); ?>

<?php $sql = "select * from tbl_user;";
$result = mysqli_query($conn,$sql);
?>
<div id="content">
    <h1 style="font-weight: bold">All users</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>

        </tr>
        </thead>
        <tbody>
<?php if($result->num_rows > 0) {?>
<?php while($row = $result->fetch_assoc()) {?>
            <tr>
                <th scope="row"><?php echo $row['user_id']?></th>
                <td><?php echo $row['username']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['customer_message']?></td>

                <td><button type="button" class="btn btn-danger" onclick="delete_user(<?php echo $row['user_id']?>)">Delete</button></td>
            </tr>

<?php }
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $delete_user = "DELETE FROM tbl_user WHERE user_id = ".$user_id;
    $deleted_user = mysqli_query($conn, $delete_user);
    if ($deleted_user) {
        $update_user = "UPDATE tbl_user SET user_id = user_id - 1 where user_id > ".$user_id;
        $reorder_user = mysqli_multi_query($conn, $update_user);
        if ($reorder_user) {
            echo 'Order of user_id updated successfully.';
        } else {
            echo 'Error updating order of user_id: ' . mysqli_error($conn);
        }
    }
    else {
        echo 'Error executing SQL script: ' . mysqli_error($conn);
    }
} }
else {
    echo "<tr><td colspan='6'>No users found.</td></tr>";
}

?>
        </tbody>
    </table>
</div>

<script>
    function delete_user(user_id) {
        // Make AJAX request to the PHP file
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        // Create a new FormData object and append the value to it
        var formData = new FormData();
        formData.append('user_id', user_id);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                window.location.href = "user_manage.php";
            }
        };
        xhr.send(formData);
    }
</script>





<?php
$conn->close();
include_once ('footer.php')?>
