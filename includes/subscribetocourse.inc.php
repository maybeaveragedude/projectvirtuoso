<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
invalidIncludesUserAcess();


if (isset($_GET['course'])){

  $learnerID = $_SESSION['learnerid'];
  $tobeSUBBEDcourseID= $_GET['course'];
  // $thistimeNow = NOW();
  $conn->autocommit(FALSE);

  $sql = $conn->prepare("INSERT INTO learners_course (l_fid, course_fid, subscription_date) VALUES (?,?,now())");

  $sql->bind_param("ss", $learnerID, $tobeSUBBEDcourseID);
  $sql->execute();

  // $sql1 = $conn->prepare("DELETE FROM course_subtopics WHERE course_fid = ?");
  //
  // $sql1->bind_param("s", $courseExistingID);
  // $sql1->execute();
  $conn->autocommit(true);

  echo <<<GFG
      <script>
        alert("Course successfully subscribed!");
        window.location.href='../learnerhome.php';
      </script>

  GFG;

} else if (isset($_GET['delete'])){

  $tobeRemovecourseID= $_GET['delete'];
  $learnerID = $_SESSION['learnerid'];

  // $thistimeNow = NOW();
  $conn->autocommit(FALSE);

  $sql = $conn->prepare("DELETE FROM learners_course WHERE l_fid = ? AND course_fid = ?");

  $sql->bind_param("ss", $learnerID, $tobeRemovecourseID);
  $sql->execute();

  // $sql1 = $conn->prepare("DELETE FROM course_subtopics WHERE course_fid = ?");
  //
  // $sql1->bind_param("s", $courseExistingID);
  // $sql1->execute();
  $conn->autocommit(true);

  echo <<<GFG
      <script>
        alert("Course removed from account!");
        window.location.href='../learnerhome.php';
      </script>

  GFG;



}
