<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
  $logedin = true;
}
else
{
  $logedin = false;
}

include "dbconnect.php";
?>
<?php echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iDiscuss</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Top Categories
                        </a>
                        <ul class="dropdown-menu">';
                        $sql = "SELECT * FROM `categories` LIMIT 3";
                        $res = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $name = $row['category_name'];
                            $id = $row['category_id'];
                            echo '
                            <li><a class="dropdown-item" href="threadlist.php?catid='. $id .'">'. $name .'</a></li>
                            ';
                        }
                        
                        echo '
                            </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#foot">About Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>';
                if($logedin)
                {
                    echo '
                    <p class="text-light my-0 mx-2">Welcome <strong>' . $_SESSION['username'] . '</strong></p>
                    <a href="logout.php" class="btn btn-outline-success ml-2">Logout</a>
                    ';
                }
                else
                {
                    echo '<button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">Signup</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">Login</button>';
                }

                

                echo '
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
'; 
include "signupModal.php";
include "loginModal.php";
?>
<?php
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true")
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>Congratulations!</strong> Your account have been created, Login to continue
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 ';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false")
{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>This email already exists!!
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 ';   
}
?>