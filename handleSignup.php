<?php include "dbconnect.php"; ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $res = mysqli_query($con, $sql);
    $affectedRows = mysqli_num_rows($res);
    if($affectedRows == 0)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_pass`) VALUES ('$username', '$email', '$hash')";
        $res = mysqli_query($con, $sql);
        header("Location: Welcome.php?signupsuccess=true");
        exit;
    }
    header("Location: Welcome.php?signupsuccess=false");
}
?>