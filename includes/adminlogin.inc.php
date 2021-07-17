<?php

if (isset($_POST["submit"])){
  //echo "It works";

//Change the below to match the admin login table
  $email = $_POST["email"];
  $pwd = $_POST["password"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputLogin($email, $pwd) !== false) {
    header("location: ../adminlogin.php?error=emptyinput");
    exit();
  }

  loginAdminUser($conn, $email, $pwd);
  header("Refresh:2; url=../adminhome.php");
}
else {
  invalidIncludesUserAcess();
  exit();
}
