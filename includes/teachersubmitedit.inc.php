<?php
session_start();
if (isset($_POST["submitSub"])){
  //echo "It works";

  $subjID = $_POST["getExistingSubID"];
  $newsubjName = $_POST["subjectname"];
  $newsubjDesc = $_POST["subjectdesc"];

  $topicID = $_POST["getExistingTopicID"];
  $newtopicName = $_POST["topicname"];
  $newtopicDesc = $_POST["topicdesc"];

  $subtopicName = $_POST["subtopicname"];
  $subtopicDesc = $_POST["subtopicdesc"];
  // $subtopicDesc = preg_replace("/(?<!\s);(?!\s)/", "/", $subtopicDesc);

  $teacherid = $_SESSION["teacherid"];

  $scenarioNo = $_POST["hiddenTotalCount"];

  if(isset($_POST["hiddenExistingSubtopicID"])){
    $existingSubtopicId = $_POST["hiddenExistingSubtopicID"];
  }

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  // if ((isset($_POST["getExistingSubID"]) || !empty($_POST["getExistingSubID"])) || (!isset($_POST["getExistingTopicID"]) || !empty($_POST["getExistingTopicID"]))) {
  //   insertNewSubtopic_SubjExist_TopicExist($conn, $topicID, $subtopicName, $subtopicDesc, $teacherid);
  //   echo "<script>alert('New subtopic created successfully!');</script>";
  // } elseif (isset($_POST["getExistingSubID"]) || !empty($_POST["getExistingSubID"])) {
  //   insertNewSubtopic_SubjExist_NEWTopic($conn, $subjID, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid);
  //   echo "<script>alert('New topic and subtopic created successfully!');</script>";
  // } else {
  //   insertNewSubtopic_NEWSubj_NEWTopic($conn, $newsubjName, $newsubjDesc, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid);
  //   echo "<script>alert('New subject, topic and subtopic created successfully!');</script>";
  // }
  switch ($scenarioNo) {
    case '0':
      insertNewSubtopic_SubjExist_TopicExist($conn, $topicID, $subtopicName, $subtopicDesc, $teacherid);
      break;

    case '1':
      insertNewSubtopic_SubjExist_NEWTopic($conn, $subjID, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid);
      break;

    case '2':
      insertNewSubtopic_NEWSubj_NEWTopic($conn, $newsubjName, $newsubjDesc, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid);
      break;

    case '3':
      UpdateSubtopic_SubjExist_TopicExist($conn, $topicID, $existingSubtopicId, $subtopicName, $subtopicDesc, $teacherid);
      break;

    default:
      header("location: ../teacherhome.php?error=unknown");
      break;
  }
  headlesstaillessretrieveSubjects();

}
else {
  invalidIncludesUserAcess();
  exit();
}
