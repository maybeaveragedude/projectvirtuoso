<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])){
  //echo "It works";

  $email = $_POST["email"];
  $pwd = $_POST["password"];



  if (emptyInputLogin($email, $pwd) !== false) {
    header("location: ../teacherlogin.php?error=emptyinput");
    exit();
  }

  loginTeacherUser($conn, $email, $pwd);
  header("Refresh:2; url=../teacherhome.php");

}
else {
  invalidIncludesUserAcess();
  exit();
}
