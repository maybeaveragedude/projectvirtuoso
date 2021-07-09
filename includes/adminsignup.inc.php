<?php

if (isset($_POST["signup"])){


  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $pwd = $_POST["password"];
  $pwdRepeat = $_POST["password-repeat"];

  //echo $name . $username . $email . $pwd .$pwdRepeat;

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $username, $email, $pwd, $pwdRepeat) !== false) {
    //changed filename
    header("location: ../adminsignup.php?error=emptyinput");
    exit();
  }

  if (invalidname($name) !== false) {
    //changed filename
    header("location: ../adminsignup.php?error=invalidname");
    exit();
  }

  if (invalidusername($username) !== false) {
    ////changed filename
    header("location: ../adminsignup.php?error=invalidusername");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    //changed filename
    header("location: ../adminsignup.php?error=passwordsdontmatch");
    exit();
  }

  if (usernameExists($conn, $username, $email) !== false) {
    //changed filename
    header("location: ../adminsignup.php?error=usernametaken");
    exit();
  }

  createUser($conn, $name, $username, $email, $pwd);


}
else {
  //changed filename
  header("location: ../adminsignup.php");
  exit();
}
