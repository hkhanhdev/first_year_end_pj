<?php include_once('master/header.php') ;?>
<body>
<div id="signup_login_contact_form">
    <h1>Sign up</h1>
    <div class="signup_login_contact_form_box">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <label for="">Username:</label> <br>
            <input type="text"  name="username"> <br>
            <label for="">Email:</label> <br>
            <input type="text"  name="email"> <br>
            <label for="">Password:</label> <br>
            <input type="password"  name="password"> <br>
            <label for="">Retype password:</label> <br>
            <input type="password"  name="password_retyped"> <br>
            <input type="submit" value="Sign up" name="submit">
        </form>
    </div>
</div>

<?php
include_once('master/database.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['username'])) {
        echo 'Please enter your username';
    }
    elseif (empty($_POST['email'])) {
        echo "Please enter your new email";
    }
    elseif (empty($_POST['password'])) {
        echo "Please enter your new password";
    }
    elseif (empty($_POST['password_retyped'])) {
        echo "Please enter your new password again";
    }
    else {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $retyped_password = $_POST['password_retyped'];
        if($password != $retyped_password) {
            echo "<p class=".htmlspecialchars('text-danger').">Password is not match</p> ";
        }else {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                echo "<p class=".htmlspecialchars('text-danger').">Your email is invalid</p> ";
            }else {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $sql = "select email from tbl_user where email = '$email'";
                $result = $conn ->query($sql);
                // Check if any rows are returned
                if ($result->num_rows == 0) {
//                if not then insert value to db
                    $sql = "insert into tbl_user(username,user_pass,email) values('$username','$hashed_password','$email')";
                    $result = $conn ->query($sql);
                    if ($result === TRUE) {
                        echo "<p class=".htmlspecialchars('text-success').">Signed up succesfully</p> ";
                    }
                    else {
                            echo "<p class=".htmlspecialchars('text-danger').">Error</p> ";
                    }
                }
                else {
                    echo "<p class=".htmlspecialchars('text-danger').">Email you typed in already existed</p> ";
                }
            }
        }
    }
}
$conn->close() ;
?>




</body>


<?php include_once('master/footer.php') ;?>
