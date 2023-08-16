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
            <th scope="col">Status</th>

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
<?php if ($row['is_accessible'] == 1) { ?>
                <td class="table-success">Allowed</td>
<?php }else{?>
                <td class="table-danger">Banned</td>
<?php }?>
                <td><button type="button" class="btn btn-success" onclick="update_user(<?php echo $row['user_id']?>,1)">Unban</button></td>
                <td><button type="button" class="btn btn-danger" onclick="update_user(<?php echo $row['user_id']?>,0)">Ban</button></td>
            </tr>

<?php }
if (isset($_POST['user_id']) && isset($_POST['status'])) {
    $user_id = $_POST['user_id'];
    $update_user = "UPDATE tbl_user SET is_accessible = ".$_POST['status']." where user_id = ".$user_id;
    $updated_user = mysqli_multi_query($conn, $update_user);
}
}else {
    echo "<tr><td colspan='6'>No users found.</td></tr>";
}
?>
        </tbody>
    </table>
</div>

<script>
    function update_user(user_id,status) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        var formData = new FormData();
        formData.append('user_id', user_id);
        formData.append('status', status);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert("Updating ...")
                window.location.href = "user_manage.php";
            }
        };
        xhr.send(formData);
    }
</script>





<?php
$conn->close();
include_once ('footer.php')?>
