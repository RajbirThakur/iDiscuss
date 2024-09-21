<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iDiscuss</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php
        include "nav.php";
        include "dbconnect.php";
    ?>
    <div class="container my-3">
        <h2>Search Results for <em>"<?php echo $_GET['search']; ?>"</em></h2>
        <?php

        $search = $_GET['search'];
        $res_exist = false;
        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) against ('$search')";
        $res = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($res))
        {
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $sql1 = "SELECT * FROM `users` WHERE Sno = $thread_user_id";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $user = $row1['user_name'];
            $res_exist = true;
            echo '<div class="media my-4">
                        <div class="media-body">
                            <h5 class="mt-0" style="font-size: 22px;"><a class="text-dark" style="text-decoration:none;"
                                    href="thread.php?threadid='. $thread_id .'&user='. $user .'">'. $thread_title .'</a></h5>
                            '. $thread_desc .'
                        </div>
                    </div>';
            }
            if(!$res_exist)
            {
                echo '<div class="jumbotron jumbotron-fluid my-4">
                    <div class="container">
                        <h3 class="display-4">No Results Found</h3>
                        <p class="lead">Suggestions:
                            <ul>
                                <li>Make sure that all the words are spelled correctly</li>
                                <li>Try different keywords</li>
                                <li>Try more general keywords</li>
                            </ul>
                        </p>
                    </div>
                    </div>';
            }

        ?>
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