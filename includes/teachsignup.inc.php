<?php

if (isset($_POST["completeform"])){

//getting variables from teacher form post
//step1
  $name = $_POST["fullname"];
  $email = $_POST["email"];
//step2
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["rptpwd"];
  $subjectCombined = '';
//step3
  if(!empty($_POST['checklist'])) {
    // foreach($_POST['checklist'] as $check) {
    //         $subjectCombined .= $check;
            //concat the value set in the HTML form for each checked checkbox.
        $subjectCombined = join(", ", $_POST['checklist']);

  }
  $othersub = $_POST["Otherunlistedsubjects"];
  if (!empty($othersub)){
      $subjectCombined .= ", ".$othersub;
  }
//step4
  $years = $_POST["years"];
  $briefexp = $_POST["briefexp"];
//step5
  //for file uploads
  $targetDir = "../uploads/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  $weburl = $_POST["Websiteforreferences"];
  $last_teacher_id = '';
  $last_up_id = '';


// the variables are incomplete
//remember to do checklist thingy
  //echo $name . $username . $email . $pwd .$pwdRepeat;

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  // if (emptyInputSignup($name, $username, $email, $pwd, $pwdRepeat) !== false) {
  //   header("location: ../teachsignupbuffer.php?error=emptyinput");
  //   exit();
  // }

  if (invalidname($name) !== false) {
    header("location: ../teachsignupbuffer.php?error=invalidname");
    exit();
  }

  if (invalidusername($username) !== false) {
    header("location: ../teachsignupbuffer.php?error=invalidusername");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../teachsignupbuffer.php?error=passwordsdontmatch");
    exit();
  }

  if (usernameTeacherExists($conn, $username, $email) !== false) {
    header("location: ../teachsignupbuffer.php?error=usernametaken");
    exit();
  }
//file uploads
  if (!empty($_FILES["file"]["name"])){
      // Allow certain file formats
      $allowTypes = array('jpg','png','jpeg','gif','pdf');
      if(in_array($fileType, $allowTypes)){
          // Upload file to server
          if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
              // Insert image file name into database
              $insert = $conn->query("INSERT into uploads (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
              if($insert){
                  $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                  $last_up_id = $conn->insert_id;
                  echo "<script>alert('$statusMsg');</script>";
              }else{
                  $statusMsg = "File upload failed, please try again.";
                  echo "<script>alert('$statusMsg');</script>";
                  header("location: ../teachsignupbuffer.php?error");
                  exit();
              }
          }else{
              $statusMsg = "Sorry, there was an error uploading your file.";
              echo "<script>alert('$statusMsg');</script>";
              header("location: ../teachsignupbuffer.php?error");
              exit();
          }
      }else{
          $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
          echo "<script>alert('$statusMsg');</script>";
          header("location: ../teachsignupbuffer.php?error");
          exit();
      }
  }

  // createTeacherUser($conn, $name, $username, $email, $pwd);
  // echo "<script>alert('$last_teacher_id');</script>";
  // createTeacherProposal($conn, $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id);
  createTeacherAndProposal($conn, $name, $username, $email, $pwd, $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id);
  loginTeacherUser($conn, $email, $pwd);

//file is uploaded > teacher account is created > proposal is saved with file upload and teacher id

}
else {
  header("location: ../teachsignupbuffer.php");
  exit();
}
