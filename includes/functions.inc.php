<?php

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
    $_SESSION["adminid"] = $usernameExists["admin_ID"];
    $_SESSION["adminname"] = $usernameExists["admin_username"];

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
      header("location: ../teachlogin.php?error=wronglogin");
      exit();
    }
    elseif ($checkPwd === true) {
      session_start();
      $_SESSION["teacherid"] = $usernameExists["t_ID"];
      $_SESSION["username"] = $usernameExists["t_username"];
      // retrieveTeacherSubjects($conn);
      headlesstaillessretrieveSubjects($conn);
      headlesstailessretrieveTeacherCourse($conn);
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
    header("Refresh:5; url=../teacheredit.php");

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
    foreach($checkSubjects[0] as $result) { //this is for checking the results from query
      echo $result['sbjt_name'], '<br>';
      // $localvarName[]= $result['sbjt_name'];
      // $_SESSION["teachersubjectsName"] = $localvarName;


      echo $result['sbjt_desc'], '<br>';
      $localvarDesc[]= $result['sbjt_desc'];
      // $_SESSION["teachersubjectsDesc"] = $localvarDesc;

      echo '<br>';
    }

    foreach($checkTopics[0] as $result) { //this is for checking the results from query
      echo $result['topic_name'], '<br>';
      // $localvarName[]= $result['sbjt_name'];
      // $_SESSION["teachersubjectsName"] = $localvarName;


      echo $result['topic_desc'], '<br>';
      // $localvarDesc[]= $result['sbjt_desc'];
      // $_SESSION["teachersubjectsDesc"] = $localvarDesc;

      echo '<br>';
    }
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

    header("Refresh:2; url=../teacherhome.php");
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

    // exit();
}
