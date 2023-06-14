<?php
include_once('master/header.php');
include_once ('master/database.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['email'])) {
        echo "<span class=".htmlspecialchars('text-danger').">Please enter your email</span>";
    }
    elseif (empty($_POST['message'])) {
        echo "<span class=".htmlspecialchars('text-danger').">Please enter your message</span>";
    }
    else {
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $message = filter_input(INPUT_POST,'message',FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "select email from tbl_user where email = '$email'";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $sql = "update tbl_user set customer_email = '$email',customer_message = '$message' where email = '$email'";
            $update = mysqli_query($conn,$sql);
            if ($update == TRUE) {
                echo "Record updated successfully";
            }
            else {
                echo "Error".$conn->error;
            }
        }else {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                echo "<p class=".htmlspecialchars('text-danger').">That's not a valid format of an email</p> ";
            }else {
                echo "Your email you typed in is not registered";
            }
        }
    }
    $conn ->close();
}
?>
<body>
<div id="signup_login_contact_form">
    <h1>Contact</h1>
    <div class="signup_login_contact_form_box">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <label for="">Email:</label> <br>
            <input type="email"  name="email"> <br>
            <label for="">Message:</label> <br>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea> <br> <br>
            <input type="submit" value="Send" name="submit">
        </form>
    </div>
</div>
</body>
<?php include_once('master/footer.php') ;?>
