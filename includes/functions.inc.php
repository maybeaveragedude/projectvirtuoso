<?php
function invalidIncludesUserAcess() {
  if(!isset($_SESSION['username'])){
    $statusMessage = '\nSTOP RIGHT THERE Criminal Scum!\n\nPlease LOGIN with your account credentials or CREATE AN ACCOUNT before proceeding.';
    echo <<<GFG
      <script>
        alert("$statusMessage");
        window.location.href='../index.php?error=internetpolice';
      </script>
    GFG;
    exit();
  }
}

function loggedInInvalidIncludesUserAcess() {
  if(isset($_SESSION['username'])){
    $tempname = $_SESSION['username'];
    $statusMessage = '\nSTOP RIGHT THERE Criminal Scum!\n\nYou are already logged in as '.$tempname.'!';

    echo <<<GFG
      <script>
        alert("$statusMessage");
        window.location.href='../index.php';
      </script>
    GFG;
    exit();
  }
}
function emptyInputSignup($name, $username, $email, $pwd, $pwdRepeat) {
  $result;
  if (empty($name) || empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidname($name) {
  $result;
  if (!preg_match("/^[A-Za-z\s]*$/", $name)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidusername($username) {
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function usernameExists($conn, $username, $email) {
  $sql = "SELECT * FROM learners WHERE l_username = ? OR l_email = ? ;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }
  else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $username, $email, $pwd) {
  $sql = "INSERT INTO learners (l_email, l_pwd, l_username, l_name) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $email, $hashedPwd, $username, $name);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  loginUser($conn, $email, $pwd);
  exit();
}

function emptyInputLogin($email, $pwd) {
  $result;
  if (empty($email) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $email, $pwd) {
  $usernameExists = usernameExists($conn, $email, $email);

  if ($usernameExists === false) {
    header("location: ../login.php?error=wronglogin");
  }

  $pwdHashed = $usernameExists["l_pwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  elseif ($checkPwd === true) {
    session_start();
    $_SESSION["learnerid"] = $usernameExists["l_ID"];
    $_SESSION["username"] = $usernameExists["l_username"];
    header("location: ../learnerhome.php");
    exit();
  }
}
  //Admin Create User function - Mark
function createAdminUser($conn, $name, $username, $email, $pwd) {
  //Change the table name and column names
  //$sql = "INSERT INTO /*Admin table name*/ (/*Admin Table column values*/) VALUES (?, ?, ?, ?);";
  $sql = "INSERT INTO admin (admin_name, admin_username, admin_email, admin_pwd) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../adminsignup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../adminsignup.php?error=none");
  exit();
}

function usernameAdminExists($conn, $username, $email) {
    $sql = "SELECT * FROM admin WHERE admin_username = ? OR admin_email = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../teachsignupbuffer.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
      return $row;
    }
    else {
      $result = false;
      return $result;
    }
    mysqli_stmt_close($stmt);
}

//Admin Login Function - Mark
function loginAdminUser($conn, $email, $pwd) {
  $usernameExists = usernameAdminExists($conn, $email, $email);

  if ($usernameExists === false) {
    header("location: ../adminlogin.php?error=wronglogin");
  }

  // $pwdHashed = $usernameExists["l_pwd"];
  $pwdHashed = $usernameExists["admin_pwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../adminlogin.php?error=wronglogin");
    exit();
  }
  elseif ($checkPwd === true) {
    session_start();
    $_SESSION["adminid"] = $usernameExists["admin_id"];
    $_SESSION["adminname"] = $usernameExists["admin_username"];
    adminRetrieveCourses($conn);
    header("location: ../adminhome.php");
    exit();
  }
}

  //teacher account creation
function usernameTeacherExists($conn, $username, $email) {
    $sql = "SELECT * FROM teacher WHERE t_username = ? OR t_email = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("location: ../teachsignupbuffer.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
      return $row;
    }
    else {
      $result = false;
      return $result;
    }
    mysqli_stmt_close($stmt);
}

  // function createTeacherUser($conn, $name, $username, $email, $pwd) {
  //   $sql = "INSERT INTO teacher (t_username, t_name, t_email, t_pwd) VALUES (?, ?, ?, ?);";
  //
  //   $stmt = mysqli_stmt_init($conn);
  //   if (!mysqli_stmt_prepare($stmt, $sql)){
  //     header("location: ../teachsignupbuffer.php?error=stmtfailed");
  //     exit();
  //   }
  //
  //   $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  //
  //   mysqli_stmt_bind_param($stmt, "ssss", $username, $name, $email, $hashedPwd);
  //   mysqli_stmt_execute($stmt);
  //   $last_teacher_id = $conn->insert_id;
  //   //teacher id is saved for referral in proposal
  //   // echo "<script>alert('$last_teacher_id');</script>";
  //   mysqli_stmt_close($stmt);
  //   exit();
  // }
  //
  // function createTeacherProposal($conn, $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id) {
  //   $sql = "INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?);";
  //   $stmt = mysqli_stmt_init($conn);
  //   if (!mysqli_stmt_prepare($stmt, $sql)){
  //     header("location: ../teachsignupbuffer.php?error=stmtfailed");
  //     exit();
  //   }
  //
  //   //$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  //
  //   mysqli_stmt_bind_param($stmt, "ssssss", $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id);
  //   mysqli_stmt_execute($stmt);
  //   mysqli_stmt_close($stmt);
  //   header("location: ../teachsignupbuffer.php?error=none");
  //   exit();
  // }


function createTeacherAndProposal($conn, $name, $username, $email, $pwd, $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id){
    $sql = "INSERT INTO teacher (t_username, t_name, t_email, t_pwd) VALUES (?, ?, ?, ?);";

    $conn->autocommit(FALSE);
    $sql1 = $conn->prepare("INSERT INTO teacher (t_username, t_name, t_email, t_pwd) VALUES (?, ?, ?, ?)");
    $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");


    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql1->bind_param("ssss", $username, $name, $email, $hashedPwd);
    $sql1->execute();

    $last_teacher_id = $conn->insert_id; //teacher id is saved for referral in proposal

    $sql2->bind_param("ssssss", $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id);
    $sql2->execute();

    $conn->autocommit(true);
    // echo "<script>alert('Account created successfully!');</script>";
    header("location: ../teachsignupbuffer.php?error=none");

}

function loginTeacherUser($conn, $email, $pwd) {
    $usernameExists = usernameTeacherExists($conn, $email, $email);

    if ($usernameExists === false) {
      header("location: ../teacherlogin.php?error=wronglogin");
    }

    $pwdHashed = $usernameExists["t_pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../teacherlogin.php?error=wronglogin");
      exit();
    }
    elseif ($checkPwd === true) {
      session_start();
      $_SESSION["teacherid"] = $usernameExists["t_ID"];
      $_SESSION["username"] = $usernameExists["t_username"];
      $_SESSION["teacherstatus"] = $usernameExists["t_status"];
      // retrieveTeacherSubjects($conn);
      headlesstaillessretrieveSubjects($conn);
      headlesstailessretrieveTeacherCourse($conn);
      retrieveTeacherMaterials($conn);
      header("location: ../teacherhome.php");
      exit();
    }
}

function checkTeacherSubjects($conn, $teacherid) { //to list out materials created by tagged teacher
    $sql = "SELECT * FROM subject WHERE t_fid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkLearners($conn) {
    $sql = "SELECT * FROM learners;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}


function checkSubjects($conn) {
    $sql = "SELECT * FROM subject;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkTopics($conn) {
    $sql = "SELECT * FROM topic;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkSubtopics($conn) {
    $sql = "SELECT * FROM subtopic;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveSubjects($conn) {
    session_start();
    header("Refresh:0; url=../teacheredit.php");

      $checkSubjects[] = checkSubjects($conn);
      $checkTopics[] = checkTopics($conn);
      $checkSubtopics[] = checkSubtopics($conn);
     //getting the $row results from checkSubjects function
    // $_SESSION["teachersubjectsName"] = $checkSubjects["sbjt_name"]; //putting them into variables
    // $_SESSION["teachersubjectsDesc"] = $checkSubjects["sbjt_desc"];
    // foreach ($checkSubjects as $value){
    //   echo '<pre>'; print_r($value); echo '</pre>';
    // }
    // foreach ($checkTopics as $value){
    //   echo '<pre>'; print_r($value); echo '</pre>';
    // }

// THIS SNIPPET IS FOR RESULT TESTING ONLY
    // foreach($checkSubjects[0] as $result) { //this is for checking the results from query
    //   echo $result['sbjt_name'], '<br>';
    //   // $localvarName[]= $result['sbjt_name'];
    //   // $_SESSION["teachersubjectsName"] = $localvarName;
    //
    //
    //   echo $result['sbjt_desc'], '<br>';
    //   $localvarDesc[]= $result['sbjt_desc'];
    //   // $_SESSION["teachersubjectsDesc"] = $localvarDesc;
    //
    //   echo '<br>';
    // }
    //
    // foreach($checkTopics[0] as $result) { //this is for checking the results from query
    //   echo $result['topic_name'], '<br>';
    //   // $localvarName[]= $result['sbjt_name'];
    //   // $_SESSION["teachersubjectsName"] = $localvarName;
    //
    //
    //   echo $result['topic_desc'], '<br>';
    //   // $localvarDesc[]= $result['sbjt_desc'];
    //   // $_SESSION["teachersubjectsDesc"] = $localvarDesc;
    //
    //   echo '<br>';
    // }
    // echo $_SESSION["teachersubjectsName"][0], '<br>';
    $_SESSION["teachersubjectsCombined"] = $checkSubjects;
    $_SESSION["teachertopicsCombined"] = $checkTopics;
    $_SESSION["teachersubtopicsCombined"] = $checkSubtopics;
    exit();
}

function headlesstaillessretrieveSubjects($conn) {
      $checkSubjects[] = checkSubjects($conn);
      $checkTopics[] = checkTopics($conn);
      $checkSubtopics[] = checkSubtopics($conn);

// // THIS SNIPPET IS FOR RESULT TESTING ONLY
//     foreach($checkSubjects[0] as $result) { //this is for checking the results from query
//       echo $result['sbjt_name'], '<br>';
//       // $localvarName[]= $result['sbjt_name'];
//       // $_SESSION["teachersubjectsName"] = $localvarName;
//
//
//       echo $result['sbjt_desc'], '<br>';
//       $localvarDesc[]= $result['sbjt_desc'];
//       // $_SESSION["teachersubjectsDesc"] = $localvarDesc;
//
//       echo '<br>';
//     }
//
//     foreach($checkTopics[0] as $result) { //this is for checking the results from query
//       echo $result['topic_name'], '<br>';
//       // $localvarName[]= $result['sbjt_name'];
//       // $_SESSION["teachersubjectsName"] = $localvarName;
//
//
//       echo $result['topic_desc'], '<br>';
//       // $localvarDesc[]= $result['sbjt_desc'];
//       // $_SESSION["teachersubjectsDesc"] = $localvarDesc;
//
//       echo '<br>';
//     }
    // echo $_SESSION["teachersubjectsName"][0], '<br>';
    $_SESSION["teachersubjectsCombined"] = $checkSubjects;
    $_SESSION["teachertopicsCombined"] = $checkTopics;
    $_SESSION["teachersubtopicsCombined"] = $checkSubtopics;

}

function retrieveTeacherSubjects($conn) {

    if (isset($_SESSION["teacherid"])){
      $teacherid = $_SESSION["teacherid"];
      $checkSubjects[] = checkTeacherSubjects($conn, $teacherid);
      echo "<script>alert('With teacher');</script>";

    }

     //getting the $row results from checkSubjects function
    // $_SESSION["teachersubjectsName"] = $checkSubjects["sbjt_name"]; //putting them into variables
    // $_SESSION["teachersubjectsDesc"] = $checkSubjects["sbjt_desc"];
    // foreach ($checkSubjects as $value){
    //   echo '<pre>'; print_r($value); echo '</pre>';
    // }

// THIS SNIPPET IS FOR RESULT TESTING ONLY
    foreach($checkSubjects[0] as $result) { //this is for checking the results from query
      echo $result['sbjt_name'], '<br>';
      $localvarName[]= $result['sbjt_name'];
      $_SESSION["teachersubjectsName"] = $localvarName;


      echo $result['sbjt_desc'], '<br>';
      $localvarDesc[]= $result['sbjt_desc'];
      $_SESSION["teachersubjectsDesc"] = $localvarDesc;



      echo '<br>';
    }
    // echo $_SESSION["teachersubjectsName"][0], '<br>';
    $_SESSION["singleteachersubjectsCombined"] = $checkSubjects;
    header("Refresh:2; url=../teacherhome.php");
    exit();
}

function insertNewSubtopic_SubjExist_TopicExist($conn, $topicID, $subtopicName, $subtopicDesc, $teacherid) {
  // $sql = "INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?);";

  $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?)");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");


  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  $sql1->bind_param("ssss", $subtopicName, $subtopicDesc, $teacherid, $topicID);
  $sql1->execute();

  $conn->autocommit(true);
  headlesstaillessretrieveSubjects($conn);
  header("location: ../teacherhome.php?create=newsubtopic");
  exit();
}

function insertNewSubtopic_SubjExist_NEWTopic($conn, $subjID, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid) {
  // $sql = "INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?);";

  $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("INSERT INTO topic (t_fid, topic_name, topic_desc, sbjt_fid) VALUES (?, ?, ?, ?)");
  $sql2 = $conn->prepare("INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?)");


  $sql1->bind_param("ssss", $teacherid, $newtopicName, $newtopicDesc, $subjID);
  $sql1->execute();

  $last_newTopic_id = $conn->insert_id; //teacher id is saved for referral in proposal

  $sql2->bind_param("ssss", $subtopicName, $subtopicDesc, $teacherid, $last_newTopic_id);
  $sql2->execute();

  $conn->autocommit(true);
  headlesstaillessretrieveSubjects($conn);
  header("location: ../teacherhome.php?create=newtopicsubtopic");
  exit();
}

function insertNewSubtopic_NEWSubj_NEWTopic($conn, $newsubjName, $newsubjDesc, $newtopicName, $newtopicDesc, $subtopicName, $subtopicDesc, $teacherid) {
  // $sql = "INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?);";

  $conn->autocommit(FALSE);
  $sql = $conn->prepare("INSERT INTO subject (sbjt_name, sbjt_desc, t_fid) VALUES (?, ?, ?)");
  $sql1 = $conn->prepare("INSERT INTO topic (t_fid, topic_name, topic_desc, sbjt_fid) VALUES (?, ?, ?, ?)");
  $sql2 = $conn->prepare("INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?)");

  $sql->bind_param("sss", $newsubjName, $newsubjDesc, $teacherid);
  $sql->execute();

  $last_newSubj_id = $conn->insert_id;

  $sql1->bind_param("ssss", $teacherid, $newtopicName, $newtopicDesc, $last_newSubj_id);
  $sql1->execute();

  $last_newTopic_id = $conn->insert_id; //teacher id is saved for referral in proposal

  $sql2->bind_param("ssss", $subtopicName, $subtopicDesc, $teacherid, $last_newTopic_id);
  $sql2->execute();

  $conn->autocommit(true);
  headlesstaillessretrieveSubjects($conn);
  header("location: ../teacherhome.php?create=newsubjecttopicsubtopic");
  exit();
}

function UpdateSubtopic_SubjExist_TopicExist($conn, $topicID, $existingSubtopicId, $subtopicName, $subtopicDesc, $teacherid) {
  // $sql = "INSERT INTO subtopic (sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?);";

  $conn->autocommit(FALSE);
  // $sql1 = $conn->prepare("DELETE FROM subtopic WHERE sub_id = ?");
  $sql1 = $conn->prepare("UPDATE subtopic SET sub_name = ?, sub_desc = ? WHERE sub_id = ? ");

  // $sql2 = $conn->prepare("INSERT INTO subtopic (sub_id, sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?, ?)");


  // $sql1->bind_param("s", $existingSuptopicId);
  $sql1->bind_param("sss", $subtopicName, $subtopicDesc, $existingSubtopicId);

  $sql1->execute();

  // $sql2->bind_param("sssss", $existingSubtopicId, $subtopicName, $subtopicDesc, $teacherid, $topicID);
  // $sql2->execute();

  $conn->autocommit(true);
  headlesstaillessretrieveSubjects($conn);
  header("location: ../teacherhome.php?subtopicedit=successful");
  exit();
}

function checkCourse($conn, $teacherid) {
    $sql = "SELECT * FROM course WHERE t_fid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkGlobalCourse($conn) {
    $sql = "SELECT * FROM course";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkLearnerSubscribedCourse($conn, $learnerID) {
    $sql = "SELECT * FROM learners_course WHERE l_fid = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $learnerID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveLearnerCourse($conn) {


      $learnerID = $_SESSION["learnerid"];
      $checkLearnerSubscribedCourse[] = checkLearnerSubscribedCourse($conn, $learnerID);
      // $coursefid = $checkCourse[]
      // echo "<script>alert('Retrieving teacher course');</script>";
    //
    //
    // $i =0;
    // foreach ($checkCourse as $value){
    //   // echo '<pre>'; print_r($value); echo '</pre>';
    //
    //
    //   foreach ($value as $coursefid){
    //     // echo '<pre>'; print_r($coursefid['course_id']); echo '</pre>';
    //     $coursetempfid= $coursefid['course_id'];
    //     $tempcheck[] = checkCourseSubtopics($conn, $coursetempfid);
    //     // array_push($checkCourseSubtopics, $tempcheck);
    //
    //   }
    //   // echo '<pre>'; print_r($tempcheck); echo '</pre>';
    //
    //   $i += 1;
    //
    // }

    $_SESSION["learnerCourse"] = $checkLearnerSubscribedCourse;
    // $_SESSION["singleTeacherCourseSubtopics"] = $tempcheck;

    // header("Refresh:2; url=../teacherhome.php");
    // exit();
}


function retrieveTeacherCourse($conn) {


      $teacherid = $_SESSION["teacherid"];
      $checkCourse[] = checkCourse($conn, $teacherid);
      // $coursefid = $checkCourse[]
      // echo "<script>alert('Retrieving teacher course');</script>";


    $i =0;
    foreach ($checkCourse as $value){
      // echo '<pre>'; print_r($value); echo '</pre>';


      foreach ($value as $coursefid){
        // echo '<pre>'; print_r($coursefid['course_id']); echo '</pre>';
        $coursetempfid= $coursefid['course_id'];
        $tempcheck[] = checkCourseSubtopics($conn, $coursetempfid);
        // array_push($checkCourseSubtopics, $tempcheck);

      }
      // echo '<pre>'; print_r($tempcheck); echo '</pre>';

      $i += 1;

    }

    $_SESSION["singleTeacherCourse"] = $checkCourse;
    $_SESSION["singleTeacherCourseSubtopics"] = $tempcheck;

    // header("Refresh:2; url=../teacherhome.php");
    // exit();
}

function checkCourseSubtopics($conn, $coursefid) {
    $sql = "SELECT * FROM course_subtopics JOIN subtopic ON course_subtopics.sub_fid = subtopic.sub_id WHERE course_fid = ? ORDER BY display_order;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $coursefid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function headlesstailessretrieveTeacherCourse($conn) {


      $teacherid = $_SESSION["teacherid"];
      $checkCourse[] = checkCourse($conn, $teacherid);
      $tempcheck = null;
      // $coursefid = $checkCourse[]
      // echo "<script>alert('Retrieving teacher course');</script>";


    $i =0;
    foreach ($checkCourse as $value){
      // echo '<pre>'; print_r($value); echo '</pre>';


      foreach ($value as $coursefid){
        // echo '<pre>'; print_r($coursefid['course_id']); echo '</pre>';
        $coursetempfid= $coursefid['course_id'];
        $tempcheck[] = checkCourseSubtopics($conn, $coursetempfid);
        // array_push($checkCourseSubtopics, $tempcheck);

      }
      // echo '<pre>'; print_r($tempcheck); echo '</pre>';

      $i += 1;

    }

    $_SESSION["singleTeacherCourse"] = $checkCourse;
    if ($tempcheck== null){
      $_SESSION["singleTeacherCourseSubtopics"] = "";
    } else {
      $_SESSION["singleTeacherCourseSubtopics"] = $tempcheck;
    }

    // exit();
}

function retrieveGlobalCourse($conn) {


      // $teacherid = $_SESSION["teacherid"];
      $checkGlobalCourse[] = checkGlobalCourse($conn);
      // $coursefid = $checkCourse[]
      // echo "<script>alert('Retrieving teacher course');</script>";


    $i =0;
    foreach ($checkGlobalCourse as $value){
      // echo '<pre>'; print_r($value); echo '</pre>';

      foreach ($value as $coursefid){
        // echo '<pre>'; print_r($coursefid['course_id']); echo '</pre>';
        $coursetempfid= $coursefid['course_id'];
        $tempcheck[] = checkCourseSubtopics($conn, $coursetempfid);
        // array_push($checkCourseSubtopics, $tempcheck);

      }
      // echo '<pre>'; print_r($tempcheck); echo '</pre>';

      $i += 1;

    }

    $_SESSION["GlobalCourse"] = $checkGlobalCourse;
    $_SESSION["GlobalCourseSubtopics"] = $tempcheck;

    // exit();
}

function adminRetrieveCourses($conn){

  $adCheckCourses[] = adminCheckCourse($conn);
  $i = 0;
  foreach ($adCheckCourses as $value){

    foreach($value as $coursefid){
      // echo '<pre>'; print_r($coursefid['course_id']); echo '</pre>';
      $coursetempfid = $coursefid['course_id'];
      $tempcheck[] = checkCourseSubtopics($conn,$coursetempfid);
    }
    // echo '<pre>'; print_r($tempcheck); echo '</pre>';
    $i+=1;
  }

  $_SESSION["course"] = $adCheckCourses;
  $_SESSION["courseSubtopics"] = $tempcheck;
}

function adminCheckCourse($conn) {
    $sql = "SELECT * FROM course;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function createNewMat($conn, $mat_name, $mat_file_upload, $mat_contents, $teacherid) {

  $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("INSERT INTO materials (mat_name, mat_file_upload_fid,	mat_contents, t_fid) VALUES (?, ?, ?, ?)");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");


  $sql1->bind_param("ssss", $mat_name, $mat_file_upload, $mat_contents, $teacherid);
  $sql1->execute();
  $recent_matID = $conn->insert_id;

  $conn->autocommit(true);

  return $recent_matID;
  // headlesstaillessretrieveSubjects($conn);
  // header("location: ../teacherhome.php?create=newsubtopic");
  // exit();
}

function deleteNewMat($conn, $mat_id) {

  $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("DELETE FROM materials WHERE mat_id = ?");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");


  $sql1->bind_param("s", $mat_id);
  $sql1->execute();
  // $recent_matID = $conn->insert_id;

  $conn->autocommit(true);

  // return $recent_matID;
  // headlesstaillessretrieveSubjects($conn);
  // header("location: ../teacherhome.php?create=newsubtopic");
  // exit();
}

function createNewQuiz($conn, $question, $display_order) {

  $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("INSERT INTO quiz (quiz_question, display_order) VALUES (?, ?)");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");

  $sql1->bind_param("ss", $question, $display_order);
  $sql1->execute();
  $quiz_fid = $conn->insert_id;

  return $quiz_fid;


  // $conn->autocommit(true);
  // headlesstaillessretrieveSubjects($conn);
  // header("location: ../teacherhome.php?create=newsubtopic");
  // exit();
}

function createQuizChoices($conn, $choice, $true_false, $quiz_fid) {

  // $conn->autocommit(FALSE);
  $sql2 = $conn->prepare("INSERT INTO quizz_choices (choice, true_false, quiz_fid) VALUES (?, ?, ?)");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");

  $sql2->bind_param("sss", $choice, $true_false, $quiz_fid);
  $sql2->execute();

  $conn->autocommit(true);
  // headlesstaillessretrieveSubjects($conn);
  // header("location: ../teacherhome.php?create=newsubtopic");
  // exit();
}

function groupInSubtopics_Materials($conn, $quiz_fid, $sub_fid, $mat_fid) {

  // $conn->autocommit(FALSE);
  $sql3 = $conn->prepare("INSERT INTO subtopic_materials (quiz_fid, sub_fid, mat_fid) VALUES (?, ?, ?)");
  // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");

  $sql3->bind_param("sss", $quiz_fid, $sub_fid, $mat_fid);
  $sql3->execute();

  $conn->autocommit(true);
  // headlesstaillessretrieveSubjects($conn);
  // header("location: ../teacherhome.php?create=newsubtopic");
  // exit();
}

function checkTeacherMaterials($conn, $teacherid) {
    $sql = "SELECT * FROM materials WHERE t_fid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkGlobalMaterials($conn) {
    $sql = "SELECT * FROM materials ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $teacherid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}


function checkMaterialsQuiz($conn) {
    $sql = "SELECT * FROM subtopic_materials ORDER BY sub_fid;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $matid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkQuiz($conn) {
    $sql = "SELECT * FROM quiz;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $quiz_id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function checkQuizQuestionChoices($conn) {
    $sql = "SELECT * FROM quizz_choices;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    // mysqli_stmt_bind_param($stmt, "s", $quiz_id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveTeacherMaterials($conn) {


      $teacherid = $_SESSION["teacherid"];
      $checkTeacherMaterials[] = checkTeacherMaterials($conn, $teacherid);
      $tempquiz[] = checkMaterialsQuiz($conn);
      $quizrepo[] = checkQuiz($conn);
      $quizQuestionChoices[] = checkQuizQuestionChoices($conn);


    $_SESSION["teacherMaterial"] = $checkTeacherMaterials;
    $_SESSION["teacherQuiz"] = $tempquiz;
    $_SESSION["quizRepo"] = $quizrepo;
    $_SESSION["quizQuestionChoices"] = $quizQuestionChoices;
    // header("Refresh:2; url=../teacherhome.php");
    // exit();
}

function retrieveGlobalMaterials($conn) {


      // $teacherid = $_SESSION["teacherid"];
      $checkTeacherMaterials[] = checkGlobalMaterials($conn);
      $tempquiz[] = checkMaterialsQuiz($conn);
      $quizrepo[] = checkQuiz($conn);
      $quizQuestionChoices[] = checkQuizQuestionChoices($conn);


    $_SESSION["GlobalMaterial"] = $checkTeacherMaterials;
    $_SESSION["teacherQuiz"] = $tempquiz;
    $_SESSION["quizRepo"] = $quizrepo;
    $_SESSION["quizQuestionChoices"] = $quizQuestionChoices;
    // header("Refresh:2; url=../teacherhome.php");
    // exit();
}

function getImage($conn, $uploadID) {
  $imageURL="";

  // $conn->autocommit(FALSE);
  $sql1 = $conn->prepare("SELECT * FROM uploads WHERE up_id = ? ");

  $sql1->bind_param("s", $uploadID);
  $sql1->execute();

  // mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  // mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($sql1);

  while ($row = mysqli_fetch_assoc($resultData)){
    $imageURL = 'uploads/'.$row["file_name"];
    // echo "<script>alert('{$imageURL}');</script>";
    return $imageURL;
  }
  // $conn->autocommit(TRUE);

  // $quiz_fid = $conn->insert_id;

      // while($row = $sql1->fetch_assoc()){
      //     $imageURL = 'uploads/'.$row["file_name"];
      //     echo "<script>alert('{$imageURL}');</script>";
      //
      //   }


  // return $imageURL;


}



function changeStatusActive($conn, $tID, $adminapproveid){

  $active = 1;
  $sql = "UPDATE teacher SET t_status = ?, approval_admin_fid = ? WHERE t_ID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "<script>alert('Problem connecting to database, please try again later.');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "isi", $active, $adminapproveid, $tID);
  mysqli_stmt_execute($stmt);

}

function changeStatusInactive($conn, $tID, $adminapproveid){

  $inactive = 2;
  $sql = "UPDATE teacher SET t_status = ?, approval_admin_fid = ? WHERE t_ID = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "<script>alert('Problem connecting to database, please try again later.');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "isi", $inactive, $adminapproveid, $tID);
  mysqli_stmt_execute($stmt);


}

function approveCourse($conn, $courseID, $adminapproveid){

  $status = 1;
  $sql1 = "UPDATE course SET approval_admin_fid = ?, course_status = ? WHERE course_id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql1)){
    echo "<script>alert('Problem connecting to database, please try again later.');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "iii", $adminapproveid, $status, $courseID);
  mysqli_stmt_execute($stmt);

}

function getCourseSubtopics($conn, $courseID, $adminapproveid){

  $sql2 = "SELECT sub_fid FROM course_subtopics WHERE course_fid = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql2)){
    echo "<script>alert('Problem connecting to database, please try again later. AMOGUS');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $courseID);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  $rows = [];

  while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
    // return $row;
    $rows[] = $row;
  }
  if ($row != mysqli_fetch_assoc($resultData)){
    $result = false;
    return $result;
  }
  $_SESSION["approveCourseSubtopicID"] = $rows;
}

function approveCourseSubtopics($conn, $subtopicID, $adminapproveid){

  $sql1 = "UPDATE subtopic SET approval_admin_fid = ? WHERE sub_id = ? AND approval_admin_fid IS NULL;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql1)){
    echo "<script>alert('Problem connecting to database, please try again later.');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ii", $adminapproveid, $subtopicID);
  mysqli_stmt_execute($stmt);

}
function revokeCourse($conn, $courseID, $adminapproveid){

  $status = 2;
  $sql1 = "UPDATE course SET approval_admin_fid = ?, course_status = ? WHERE course_id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql1)){
    echo "<script>alert('Problem connecting to database, please try again later.');</script>";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "iii", $adminapproveid, $status, $courseID);
  mysqli_stmt_execute($stmt);

}

function checkLearnerFeedback($conn) {
    $sql = "SELECT * FROM learner_course_feedbacks";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveLearnerFeedback($conn) {

      $checkLearnerFeedback[] = checkLearnerFeedback($conn);

    $_SESSION["learnerFeedback"] = $checkLearnerFeedback;

}

function retrieveLearners($conn) {

      $checkLearners[] = checkLearners($conn);

    $_SESSION["learnerList"] = $checkLearners;

}

function checkTeacherFeedback($conn) {
    $sql = "SELECT * FROM teacher_course_feedbacks";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveTeacherFeedback($conn) {

      $checkTeacherFeedback[] = checkTeacherFeedback($conn);

    $_SESSION["teacherFeedback"] = $checkTeacherFeedback;

}

function checkTeacherLearnerFeedback($conn) {
    $sql = "SELECT * FROM teacher_learner_feedbacks";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveTeacherLearnerFeedback($conn) {

      $checkTeacherLearnerFeedback[] = checkTeacherLearnerFeedback($conn);

    $_SESSION["teacherLearnerFeedback"] = $checkTeacherLearnerFeedback;

}

function checkTeacherList($conn) {
    $sql = "SELECT * FROM teacher";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "<script>alert('Problem connecting to database, please try again later.');</script>";
      exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $rows = [];

    while ($row = mysqli_fetch_assoc($resultData)){ //getting the rows from the query result
      // return $row;
      $rows[] = $row;
    }
    if ($row != mysqli_fetch_assoc($resultData)){
      $result = false;
      return $result;
    }

    return $rows;
    mysqli_stmt_close($stmt);
}

function retrieveTeacherList($conn) {

      $checkTeacherList[] = checkTeacherList($conn);

    $_SESSION["teacherList"] = $checkTeacherList;

}
