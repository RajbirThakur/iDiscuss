<?php include "dbconnect.php"; ?>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $res = mysqli_query($con, $sql);
    $affectedRows = mysqli_num_rows($res);
    if($affectedRows == 1)
    {
        while($row = mysqli_fetch_assoc($res))
        {
            if(password_verify($pass, $row['user_pass']))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['useremail'] = $row['user_email'];
                header("Location: Welcome.php");
            }
            header("Location: Welcome.php");
        }
    }
}

?>