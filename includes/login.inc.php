<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])){
  //echo "It works";

  $email = $_POST["email"];
  $pwd = $_POST["password"];



  if (emptyInputLogin($email, $pwd) !== false) {
    header("location: ../login.php?error=emptyinput");
    exit();
  }

  loginUser($conn, $email, $pwd);
}
else {
  invalidIncludesUserAcess();
  exit();
}
