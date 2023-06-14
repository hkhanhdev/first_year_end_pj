<?php include_once('master/header.php');
include_once('master/database.php'); ?>
    <div id="signup_login_contact_form">
    <h1>Login</h1>
    <div class="signup_login_contact_form_box">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['username'])) {
            echo "<p class=".htmlspecialchars('text-warning').">Please enter your username</p> ";
        }
        elseif (empty($_POST['email'])) {
            echo "<p class=".htmlspecialchars('text-warning').">Please enter your email</p> ";
        }
        elseif (empty($_POST['password'])) {
            echo "<p class=".htmlspecialchars('text-warning').">Please enter your password</p> ";
        }
        else {
            $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
            $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
            $password = $_POST['password'];
            $sql = "select username,user_pass,email from tbl_user where email = '$email'";
            $result = mysqli_query($conn,$sql);
            if ($email == 'admin@gmail.com' && $username == 'admin' && $password == 'admin') {
                header('Location:adm/dashboard.php');
            }
            elseif ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if($row['username'] != $username) {
                    echo "<p class=".htmlspecialchars('text-danger').">Wrong username</p> ";
                }elseif (!password_verify($password,$row['user_pass'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Wrong password</p> ";
                }
                else {
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    header("Location:index.php");
                }
            }else {
                if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                    echo "<p class=".htmlspecialchars('text-danger').">That's not a valid format of an email</p> ";
                }else {
                    echo "<p class=".htmlspecialchars('text-danger').">Your email you typed in is not registered</p> ";
                }
            }}}?>
            <label for="">Email:</label> <br>
            <input type="text"  name="email"> <br>
            <label for="">Username:</label> <br>
            <input type="text"  name="username"> <br>
            <label for="">Password:</label> <br>
            <input type="password"  name="password"> <br> <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<?php $conn->close();?>
<?php include_once('master/footer.php') ;?>