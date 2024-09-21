<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iDiscuss</title>
    <style>
        .form{
            width: 100%;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .con{
            width: 700px;
            /* border: 1px solid black; */
        }
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
        $thankuAlert = false;
        $loginAlert = false;
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
                $query = $_POST['query'];
                $sql = "INSERT INTO `query` (`query`) VALUES ('$query')";
                $res = mysqli_query($con, $sql);
                $thankuAlert = true;
            }
            else
            {
                $loginAlert = true;
            }
        }
    ?>

    <div class="form mt-5">
        <div class="con">
            <h1>Contact us here</h1>
            <form action="contact.php" method="post">
                <div class="my-5">
                    <input type="text"  placeholder="Name" type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="my-5">
                    <input type="email" placeholder="Email-Address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="my-5">
                    <input type="number" placeholder="Contact Number" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="my-5">
                    <textarea name="query" placeholder="Query/feedback" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success" style="width: -webkit-fill-available;">Submit</button>
            </form>
        </div>
        <?php 
            if($loginAlert)
            {
                echo '<div style="width:700px;" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Please Login first to raise a query
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            if($thankuAlert)
            {
                echo '<div style="width:700px;" class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Thanku for reaching out. We will back to you soon :)
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <h6 class="mt-3">Alternatively, you can email us at <span style="color: #198754;">support@iDiscuss.com</span></h6>
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
</body>

</html>