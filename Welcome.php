<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iDiscuss</title>
    <style>
        .container12{
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .innerContainer{
            display: grid;
            grid-template-columns: repeat(3, 385px);
            grid-row-gap: 20px;
            width: 1060px;
        }
        .imga{
            height: 193px;
            width: 286px;
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

    <!-- carousel -->
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="Images/i9.webp" height="530px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Images/i5.jpg" height="530px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Images/i6.jpg" height="530px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active">
                <img src="Images/i10.jpg" height="530px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Images/i11.jpg" height="530px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="Images/i12.webp" height="530px" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h2 style="text-align: center; margin: 20px;">Browse Categories</h2>
    <div class="container12">
        <div class="innerContainer">
            <?php 
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($res)){
                    $cat_id = $row['category_id'];
                    $cat_name = $row['category_name'];
                    $cat_desc = $row['category_desc'];
                    echo '<div class="card" style="width: 18rem; height: 24rem;">
                        <img class="card-img-top UnsplashImage imga" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'. $cat_name .'</h5>
                            <p class="card-text">'. substr($cat_desc,0,90) .'..</p>
                            <a href="threadlist.php?catid='. $cat_id .'" class="btn btn-success">View Thread</a>
                        </div>
                    </div>';
                }
            ?>
            
        </div>
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
    <script>
        
        // let imageElement = document.querySelectorAll(".UnsplashImage");
        Array.from(document.getElementsByClassName("UnsplashImage")).forEach((e)=>{
        let endpoint =
            `https://api.unsplash.com/photos/random/?query=<?php echo $cat_name; ?> code&client_id=GyBCo89sAQXvcOfzLKqUh7n9_LwEPo6-XgEYt6X2_cw`;
        fetch(endpoint).then(function(response) {
            return response.json();
        })
        .then(function(jsonData) {
            e.src = jsonData.urls.regular;
        })
    })

    </script>
</body>

</html>