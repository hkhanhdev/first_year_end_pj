<?php
$db_server = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'final_project';
try {
    $conn = mysqli_connect(hostname: $db_server,username: $db_user,password: $db_pass,database: $db_name);
}
catch (mysqli_sql_exception) {
    echo "Could not connect! <br>";
}

?>
