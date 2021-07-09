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
    header("location: ../signup.php?error=emptyinput");
    exit();
  }

  if (invalidname($name) !== false) {
    header("location: ../signup.php?error=invalidname");
    exit();
  }

  if (invalidusername($username) !== false) {
    header("location: ../signup.php?error=invalidusername");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }

  if (usernameExists($conn, $username, $email) !== false) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  createUser($conn, $name, $username, $email, $pwd);


}
else {
  header("location: ../signup.php");
  exit();
}
