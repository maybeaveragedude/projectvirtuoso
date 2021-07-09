<?php
$_SESSION["teachersubjectsName"] = "";
$_SESSION["teachersubjectsDesc"] = "";

// require_once 'dbh.inc.php';
// require_once 'functions.inc.php';
//
// checkSubjects($conn);
// retrieveSubjects();
// echo "<script>alert('$testtitle');</script>";

if (isset($_POST["submit"])){
  //echo "It works";

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  checkSubjects($conn);
  retrieveSubjects($conn);
  // $testtitle = $_SESSION["teachersubjectsName"];
  echo "<script>alert('$testtitle');</script>";
}
else {
  header("location: ../teacherlogin.php");
  exit();
}
