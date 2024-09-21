<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iDiscuss</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .footer{
            width: 100%;
            height: 400px;
            /* border: 1px solid black; */
            color: white;
            background: linear-gradient(180deg, #8BC34A 0%, #457026 100%);
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: column;
        }
        #categories{
            width: 300px;
            height: 130px;
            /* border: 1px solid red; */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>    
</head>

<body>
    <?php include "nav.php"; ?>
    <?php include "dbconnect.php"; ?>
    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $res = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($res)){
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
        }
    
    ?>
    <?php
         $alert = false;
         if($_SERVER['REQUEST_METHOD'] == 'POST')
         {
             $user = $_SESSION['useremail'];
             $sql = "SELECT * FROM `users` WHERE user_email = '$user'";
             $res = mysqli_query($con, $sql);
             $row = mysqli_fetch_assoc($res);
             $sno = $row['Sno'];
             $comment = $_POST['comment'];
             $comment = str_replace("<", "&lt;", $comment);
             $comment = str_replace(">", "&gt;", $comment);
             $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
             $res = mysqli_query($con, $sql);
             $alert = true;
             if($alert)
             {
                 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>Congratulations!</strong> Your comment have been successfully added, wait for someone to respond
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 ';
             }
         }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $thread_title; ?></h1>
            <p class="lead"><?php echo $thread_desc; ?></p>
            <hr class="my-4">
            <p>This is peer to peer forum for sharing knowledge with each other. As a volunteer-powered forum, you are
                expected to be kind, helpful and respectful to all, assuming the best intentions of people and trying to
                help make things better</p>
            <p class="lead">Posted by: <b><?php echo $_GET['user']; ?></b></p>
        </div>
    </div>

    <div class="container my-4">
        <h2>Post a Comment</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <?php 
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
                {
                    echo '
                    <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>';
                }
                else
                {
                    echo '<p class="lead">You are not logged in, Please Login to Post a Comment</p>';
                }
            ?>
        </form>
    </div>

    <div class="container">
        <h3 class="py-2">Discussions</h3>
        <?php 
             $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
             $res = mysqli_query($con, $sql);
             $res_exist = false;
             while($row = mysqli_fetch_assoc($res)){
                 $comment_content = $row['comment_content'];
                 $comment_time = $row['comment_time'];
                 $comment_by = $row['comment_by'];
                 $sql1 = "SELECT * FROM `users` WHERE Sno = $comment_by";
                 $res1 = mysqli_query($con, $sql1);
                 $row1 = mysqli_fetch_assoc($res1);
                 $user = $row1['user_name'];
                 $res_exist = true;
                 echo'
                 <div class="media my-4">
                     <img src="Images/default-user-image.png" class="mr-3" width="30px" alt="...">
                     <div class="media-body">
                     <p class="font-weight-bold my-0" style="color: #979393; font-size: 15px;">'. $user .' at '. $comment_time .'</p>    
                     <p class="font-weight-bold my-0">'. $comment_content .'</p>
                     </div>
                 </div>';
             }
             if(!$res_exist)
             {
                 echo '<div class="jumbotron jumbotron-fluid">
                     <div class="container">
                         <h3 class="display-4">No Results Found</h3>
                         <p class="lead">Be the first person to comment</p>
                     </div>
                     </div>';
             }
        ?>
    </div>
    <div class="footer mt-5" id="foot">
        <h2 style="font-weight:700;">iDiscuss - Online Forum</h2>
        <div id="categories">
            <h3 style="margin: 0; font-weight:400;">Categories:</h3>
            <ul style="list-style: none; margin: 0;">
                <li>Javascript</li>
                <li>Django</li>
                <li>Python</li>
                <li>Flask</li>
            </ul>
        </div>
        <h2 style="color: rgb(255 255 255 / 0.5);">Copyright 2024 iDiscuss, All rights reserved</h2>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>