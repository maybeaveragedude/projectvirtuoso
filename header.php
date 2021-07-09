<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Menu-1.css">
    <link rel="stylesheet" href="assets/css/Sidebar-Menu.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient" style="color: rgb(255, 255, 255);background: rgb(255,255,255);">
        <div class="container"><a class="navbar-brand logo" href="index.php" style="color: var(--bs-dark);font-family: Alatsi, sans-serif;"><img src="assets/img/Artboard%202@8x.png" style="width: 64px;padding: 0px;margin: -10px;">VIRTUOSO</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="text-dark visually-hidden" style="color: rgb(0,0,0);">Toggle navigation</span><span class="navbar-toggler-icon text-dark" style="color: rgb(0,0,0);background: rgba(255,255,255,0);border-color: rgba(255,255,255,0);"><i class="fa fa-bars" style="color: rgb(0,0,0);text-align: center;margin: 4px;"></i></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                      if (isset($_SESSION["learnerid"])) {
                        echo "<li class='nav-item'><a class='nav-link' href='learnerhome.php' style='color: var(--bs-dark);'>My Account</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='includes/logout.inc.php' style='color: var(--bs-dark);'>Log out</a></li>";
                      } elseif (isset($_SESSION["adminid"])){
                        echo "<li class='nav-item'><a class='nav-link' href='adminhome.php' style='color: var(--bs-dark);'>My Account</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='includes/logout.inc.php' style='color: var(--bs-dark);'>Log out</a></li>";
                      } elseif (isset($_SESSION["teacherid"])){
                        echo "<li class='nav-item'><a class='nav-link' href='teacherhome.php' style='color: var(--bs-dark);'>My Account</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='includes/logout.inc.php' style='color: var(--bs-dark);'>Log out</a></li>";
                      }
                      else {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php" style="color: var(--bs-dark);">Log In</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="signup.php" style="color: var(--bs-dark);">Sign Up</a></li>';
                      }
                    ?>
                </ul>
            </div>
        </div>
    </nav>