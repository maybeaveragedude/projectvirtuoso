<?php
  include_once 'teacherheader.php';

  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  // headlesstaillessretrieveSubjects($conn);
  headlesstailessretrieveTeacherCourse($conn);
  retrieveGlobalCourse($conn);

  invalidLearnerUserAcess();
  invalidUserAcess();

?>

<main class="page lanidng-page">
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-bottom: 50px;background: #ededed;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-3" id="avatar">
                            <picture style="width: 128px;height: 128px;"><img id="profileavatar" src="assets/img/avatars/avatar.jpg" style="width: 128px;height: 128px;border-radius: 176px;"></picture>
                        </div>
                        <div class="col d-xxl-flex align-items-xxl-center" style="display: inline-block">
                          <div>
                            <?php
                             echo '<h1 class="d-xxl-flex justify-content-xxl-start">' . "$_SESSION[username]" . '</h1>';
                              switch ($_SESSION['teacherstatus']) {
                                case 0:
                                        echo <<<GFG
                                               <h4 style="text-align: left">Status:&nbsp &nbsp Pending 🍳</h4>
                                        GFG;
                                  break;

                                case 1:
                                        echo <<<GFG
                                               <h4 style="text-align: left">Status:&nbsp &nbspActivated ✅</h4>
                                        GFG;
                                  break;
                                case 2:
                                        echo <<<GFG
                                               <h4 style="text-align: left">Status:&nbsp &nbsp Disabled 😥</h4>
                                        GFG;
                                  break;
                              }


                             //this is error handling message for users
                               if (isset($_GET["create"])) {
                                 if ($_GET["create"] == "newsubtopic") {
                                   echo "<script>alert('New subtopic created successfully!');</script>";
                                 }
                                 elseif ($_GET["create"] == "newtopicsubtopic"){
                                   echo "<script>alert('New topic and subtopic created successfully!');</script>";
                                 }
                                 elseif ($_GET["create"] == "newsubjecttopicsubtopic"){
                                   echo "<script>alert('New subject, topic and subtopic created successfully!');</script>";
                                 }
                                 elseif ($_GET["create"] == "newcourse"){
                                   echo "<script>alert('New course created successfully!');</script>";
                                 }
                               } elseif (isset($_GET["subtopicedit"])){
                                 if ($_GET["subtopicedit"] == "successful") {
                                   echo "<script>alert('Subtopic edited successfully!');</script>";
                                 }
                                 elseif ($_GET["subtopicedit"] == "error") {
                                   echo "<script>alert('Something went wrong! Please try again later.');</script>";
                                 }
                               }
                               // elseif ($_GET["error"]) {
                               //   if ($_GET["error"] == "unknown") {
                               //     echo "<script>alert('Something went wrong! Please try again later.');</script>";
                               //   }
                               // }

                            ?>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </section>
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Study Materials<br></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Personal Stats</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Feedbacks</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="tab-1">
                                <div class="accordion" role="tablist" id="accordion-1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1">My Courses</button></h2>
                                        <div class="accordion-collapse collapse show item-1 text-start" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                              <?php
                                              $countTotalCourseMade = 0;
                                              $countTotalSubsMade = 0;
                                              $countTotalMatsMade = 0;


                                              $num=0;

                                              //COURSE PART
                                                foreach ($_SESSION["singleTeacherCourse"][$num] as $display) {
                                                  // echo '<pre>'; print_r($display); echo '</pre>';

                                                  $tempCourseId = $display['course_id'];
                                                  $tempname = $display['course_name'];
                                                  $tempdesc = $display['course_desc'];
                                                  $tempTFID = $display['t_fid'];
                                                  // $tempTID = $_SESSION["teacherid"];
                                                  echo <<<GFG
                                                      <div class="coursetitle" id="coursetitle{$tempCourseId}">
                                                        <a class="btn btn-primary listgroupdropMain subjectList" style="font-size: 20px; margin: 14px 0px;"data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$num}" href="#collapseCourse-{$num}" role="button"><strong>{$tempname}</strong></a>
                                                        <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:blue;" value="View" onclick="redirectViewCourse({$tempCourseId})"></input>

                                                  GFG;
                                                  switch ($_SESSION['teacherstatus']) {

                                                    case 2:
                                                            echo <<<GFG
                                                                  <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:rgb(169, 169 ,169) !important; pointer-events: none;" value="Edit" disabled="" onclick="redirectEditCourse({$tempCourseId})"></input>
                                                                  <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:rgb(169, 169 ,169) !important; pointer-events: none;" disabled="" value="Delete" onclick="redirectDeleteCourse({$tempCourseId})"></input>

                                                                  <div class="collapse" id="collapseCourse-{$num}">

                                                            GFG;
                                                      break;

                                                    default:
                                                            echo <<<GFG
                                                                  <input class="simpleTextEdit" type="button" style="margin: 14px 0px;" value="Edit" onclick="redirectEditCourse({$tempCourseId})"></input>
                                                                  <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:red;" value="Delete" onclick="redirectDeleteCourse({$tempCourseId})"></input>

                                                                  <div class="collapse" id="collapseCourse-{$num}">

                                                            GFG;


                                                      break;
                                                  }

                                                 //  echo <<<GFG
                                                 //        <input class="simpleTextEdit" type="button" style="margin: 14px 0px;" value="Edit" onclick="redirectEditCourse({$tempCourseId})"></input>
                                                 //        <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:red;" value="Delete" onclick="redirectDeleteCourse({$tempCourseId})"></input>
                                                 //
                                                 //
                                                 //          <div class="collapse" id="collapseCourse-{$num}">
                                                 //
                                                 // GFG;
                                                    //DISPLAY ORDERED SUBTOPICS
                                                    $subsnum = 0;
                                                    foreach ($_SESSION["singleTeacherCourseSubtopics"] as $coursesubsDisp){
                                                      $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
                                                      // $tempTopSubname = $coursesubsDisp[$subsnum];
                                                      // $tempSubdesc = $coursesubsDisp[$subsnum]['sub_desc'];
                                                      // $tempSubFId = $coursesubsDisp['sbjt_fid'];
                                                      // $tempTopicId = $coursesubsDisp['topic_id'];
                                                      // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                                      if($tempCourseId == $tempinnercourse){
                                                        $countTotalCourseMade ++;
                                                        // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                                        $innercount = 0;
                                                        foreach ($coursesubsDisp as $count) {
                                                          $tempSubname = $count['sub_name'];
                                                          echo <<<GFG
                                                              <div class="singleTopicRow" id="singleTopicRow{$subsnum}">
                                                                <a class="btn btn-primary listgroupdropMain TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subsnum}" href="#collapseTopic-{$subsnum}" role="button">{$tempSubname}</a>

                                                          GFG;


                                                          echo <<<GFG



                                                                  </div>
                                                          GFG;
                                                          $innercount += 1;
                                                        }
                                                        $subsnum +=1;

                                                        }

                                                    }

                                                 echo <<<GFG

                                                          </div>
                                                      </div>

                                                  GFG;
                                                  // <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
                                                  $num += 1;
                                                }

                                               ?>
                                                <!-- <div>
                                                  <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1" role="button">Show Content</a>
                                                    <div class="collapse show" id="collapse-1">
                                                        <p>Collapse content.</p>
                                                        <form method="post" action="includes/teacheredit.inc.php">
                                                          <button class="btn btn-primary" type="submit" name="submit" style="border-radius: 7px;background: #1eb53a;">Edit</button>

                                                        </form>
                                                    </div>
                                                </div> -->
                                                <!-- <div>
                                                  <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-2" href="#collapse-2" role="button">Show Content</a>
                                                    <div class="collapse" id="collapse-2">
                                                        <p>Collapse content.</p>
                                                    </div>
                                                </div> -->
                                                <div>
                                                  <button id="courseemptyNotice" class="" style="display: none; padding: 16px 4px; margin-left: 10px; margin-bottom: 12px; cursor: default; background: #FFFFFF; border: 0px;" role="button" >It's pretty barren in here...</button>
                                                  <?php
                                                  switch ($_SESSION['teacherstatus']) {

                                                    case 2:
                                                            echo <<<GFG
                                                                  <div>
                                                                    <a class="btn btn-primary" disabled="" style="background-color: rgba(169, 169 ,169, 0.25) !important; pointer-events: none; margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;">Tinker a New Course!</a>
                                                                  </div>

                                                            GFG;
                                                      break;

                                                    default:
                                                            echo <<<GFG
                                                                  <div>
                                                                    <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="teachercourseedit.php">Tinker a New Course!</a>
                                                                  </div>

                                                            GFG;


                                                      break;
                                                  }




                                                   ?>
                                                  <!-- <div>
                                                    <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="teachercourseedit.php">Tinker a New Course!</a>
                                                  </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">My Subtopics</button></h2>
                                        <div class="accordion-collapse collapse item-2 text-start" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body" id="mymaterialAccordian">
                                              <?php
                                              $num=0;

                                              //SUBJECT PART
                                                foreach ($_SESSION["teachersubjectsCombined"][$num] as $display) {
                                                  $tempSubId = $display['sbjt_id'];
                                                  $tempname = $display['sbjt_name'];
                                                  $tempdesc = $display['sbjt_desc'];
                                                  $tempTFID = $display['t_fid'];
                                                  $tempTID = $_SESSION["teacherid"];
                                                  echo <<<GFG
                                                      <div class="singleSubjectRow" id="singleSubjectRow{$num}">
                                                        <a class="btn btn-primary listgroupdropMain subjectList" style="font-size: 20px; margin: 14px 0px;"data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$num}" href="#collapseSub-{$num}" role="button"><strong>{$tempname}</strong></a>
                                                          <div class="collapse" id="collapseSub-{$num}">

                                                 GFG;
                                                    //TOPIC PART
                                                    $topicnum = 0;
                                                    foreach ($_SESSION["teachertopicsCombined"][$topicnum] as $topicDisplay){
                                                      $tempTopicname = $topicDisplay['topic_name'];
                                                      $tempTopicdesc = $topicDisplay['topic_desc'];
                                                      $tempSubFId = $topicDisplay['sbjt_fid'];
                                                      $tempTopicId = $topicDisplay['topic_id'];
                                                      if ($tempSubFId == $tempSubId){
                                                          echo <<<GFG
                                                              <div class="singleTopicRow" id="singleTopicRow{$topicnum}">
                                                                <a class="btn btn-primary listgroupdropMain TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$topicnum}" href="#collapseTopic-{$topicnum}" role="button">{$tempTopicname}</a>
                                                                  <div class="collapse" id="collapseTopic-{$topicnum}">
                                                          GFG;

                                                          //SUBTOPIC PART
                                                          $subtopicnum = 0; //for id
                                                          foreach ($_SESSION["teachersubtopicsCombined"][$subtopicnum] as $subtopicDisplay){
                                                            $tempSubtopicname = $subtopicDisplay['sub_name'];
                                                            $tempSubtopicdesc = $subtopicDisplay['sub_desc'];
                                                            $tempTopicFId = $subtopicDisplay['topic_fid'];
                                                            $tempSubtopicId = $subtopicDisplay['sub_id'];
                                                            $tempSubtopicTeacherId = $subtopicDisplay['t_fid'];
                                                            if ($tempTopicId == $tempTopicFId){
                                                                echo <<<GFG
                                                                    <div id="{$tempSubtopicId}">
                                                                      <button class="btn btn-primary listgroupdropMain SubtopicList teacheridIs_{$tempSubtopicTeacherId}" style="margin-left: 56px; margin-top: -8px; margin-bottom: 6px; background-color:white; color:black;" data-bs-toggle="collapse"><i>{$tempSubtopicname}</i></button>
                                                                        <div class="collapse" id="collapseSubtopic-{$subtopicnum}">


                                                                            </div>
                                                                        </div>
                                                                GFG;
                                                                if ($tempSubtopicTeacherId == $tempTID){
                                                                        $countTotalSubsMade ++;
                                                                }
                                                            }
                                                            $subtopicnum +=1;
                                                          }

                                                          echo <<<GFG


                                                                      </div>
                                                                  </div>
                                                          GFG;
                                                      }
                                                      $topicnum +=1;
                                                    }

                                                 echo <<<GFG

                                                          </div>
                                                      </div>
                                                      <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
                                                  GFG;
                                                  $num += 1;
                                                }

                                               ?>

                                               <div>
                                                 <div>
                                                 <button id="emptyNotice" class="" style="display: none; padding: 16px 4px; margin-bottom: 12px; margin-left: 10px; cursor: default; background: #FFFFFF; border: 0px;" role="button" >It's pretty barren in here...</button>
                                                 <?php
                                                 switch ($_SESSION['teacherstatus']) {

                                                   case 2:
                                                           echo <<<GFG
                                                               </div>
                                                                 <a class="btn btn-primary" disabled="" style=" background-color: rgba(169, 169 ,169, 0.25) !important; pointer-events: none;margin-top: 12px; margin-left: 10px;border-radius: 7px;" href="includes/teacheredit.inc.php">Cultivate something new!</a>
                                                               </div>

                                                           GFG;
                                                     break;

                                                   default:
                                                           echo <<<GFG
                                                               </div>
                                                                 <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something new!</a>
                                                               </div>

                                                           GFG;


                                                     break;
                                                 }

                                                  ?>

<!--
                                               </div>
                                                 <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something new!</a>
                                               </div> -->
                                        </div>
                                    </div>
                                  </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">My Materials</button></h2>
                                        <div class="accordion-collapse collapse item-3 text-start" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                <!-- <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p> -->
                                                <?php
                                                $matExist = 0;

                                                            $subtopicnum = 0; //for id
                                                            foreach ($_SESSION["teachersubtopicsCombined"][$subtopicnum] as $subtopicDisplay){
                                                              $tempSubtopicname = $subtopicDisplay['sub_name'];
                                                              $tempSubtopicdesc = $subtopicDisplay['sub_desc'];
                                                              $tempTopicFId = $subtopicDisplay['topic_fid'];
                                                              $tempSubtopicId = $subtopicDisplay['sub_id'];
                                                              $tempSubtopicTeacherId = $subtopicDisplay['t_fid'];

                                                              // if ($tempTopicId == $tempTopicFId){
                                                                  echo <<<GFG
                                                                      <div id="mat{$tempSubtopicId}" style="display: none;">
                                                                        <a class="btn btn-primary listgroupdropMain MatSubtopicList teacheridIs_{$tempSubtopicTeacherId}" style="margin-left: 0px; margin-top: 6px; margin-bottom: 6px; background-color:white; color:black;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subtopicnum}" href="#collapseMatSubtopic-{$subtopicnum}" role ="button">{$tempSubtopicname}</a>
                                                                        <input type="button" class="simpleTextEdit" onclick="redirectView({$tempSubtopicId})"name="View" value="View" style="margin: 4px 0px; color:green;"></input>
                                                                        <input type="button" class="simpleTextEdit" onclick="redirectAddNewMatIn({$tempSubtopicId})"name="Add Materials" value="Add" style="margin: 4px 0px; color:blue;"></input>



                                                                          <div class="collapse" id="collapseMatSubtopic-{$subtopicnum}">

                                                                  GFG;

                                                                  $matidnum = 0; //for id
                                                                  foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                                                                    $tempMatSubId = $matIDDisplay['sub_fid'];
                                                                    $tempMatFId = $matIDDisplay['mat_fid'];

                                                                    if ($tempSubtopicId == $tempMatSubId) {
                                                                          $matnum = 0; //for id
                                                                          foreach ($_SESSION["teacherMaterial"][$matnum] as $matDisplay){
                                                                              $tempMatTitle = $matDisplay['mat_name'];
                                                                              $tempMatID = $matDisplay['mat_id'];

                                                                              if ($tempMatFId == $tempMatID){
                                                                                $matExist += 1;
                                                                                $countTotalMatsMade ++;

                                                                                echo <<<GFG
                                                                                      <script>
                                                                                          document.getElementById("mat{$tempSubtopicId}").style.display = "block";
                                                                                      </script>
                                                                                GFG;


                                                                                // echo $tempMatTitle;
                                                                                  echo <<<GFG
                                                                                      <div id="innermat{$tempMatID}" style="vertical-align:middle;">


                                                                                        <a class="btn btn-primary listgroupdropMain MatList" style="margin-left: 32px; margin-top: 0px; margin-bottom: 0px; background-color:white; color:black;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$matnum}" href="#collapseMat-{$matnum}" role ="button"><i>{$tempMatTitle}</i></a>
                                                                                        <input type="button" class="simpleTextEdit" onclick="redirectDelete({$tempMatID})"name="Delete" value="Delete" style="margin: 4px 0px; color:red;"></input>

                                                                                          <div class="collapse" id="collapseMat-{$matnum}">
                                                                                          </div>

                                                                                      </div>







                                                                                  GFG;

                                                                                }
                                                                                $matnum +=1;

                                                                        }
                                                                      }
                                                                      $matidnum +=1;

                                                                  }


                                                                  echo <<<GFG

                                                                              </div>
                                                                          </div>
                                                                  GFG;

                                                              $subtopicnum +=1;
                                                            }

                                                 ?>
                                                 <div>
                                                 <button id="emptyMat" class="" style="display: block; padding: 16px 4px; margin-bottom: 12px; margin-left: 10px; cursor: default; background: #FFFFFF; border: 0px;" role="button" >It's pretty barren in here...</button>
                                                  <?php
                                                  if ($matExist > 0) {
                                                    echo <<<GFG
                                                          <script>
                                                              document.getElementById("emptyMat").style.display = "none";
                                                          </script>

                                                    GFG;
                                                  }

                                                  switch ($_SESSION['teacherstatus']) {

                                                    case 2:
                                                            echo <<<GFG
                                                                </div>
                                                                  <a class="btn btn-primary" disabled="" style="background-color: rgba(169, 169 ,169, 0.25) !important; pointer-events: none; margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="matedit.php">Materialize More!</a>
                                                                </div>

                                                            GFG;
                                                      break;

                                                    default:
                                                            echo <<<GFG
                                                                </div>
                                                                  <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="matedit.php">Materialize More!</a>
                                                                </div>

                                                            GFG;


                                                      break;
                                                  }

                                                  ?>
                                               <!-- </div>
                                                 <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="matedit.php">Materialize More!</a>
                                               </div> -->
                                            </div>

                                            <div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-2">
                              <div class="card" style="padding: 24px;">
                                <h4>Total Tinkered Courses</h4>
                                <?php
                                echo <<<GFG
                                      <p>$countTotalCourseMade</p>
                                GFG;
                                ?>
                                <h4>Total Cultivated Subtopics</h4>
                                <?php
                                echo <<<GFG
                                      <p>$countTotalSubsMade</p>
                                GFG;
                                ?>
                                <h4>Total Materialized Materials</h4>
                                <?php
                                echo <<<GFG
                                      <p>$countTotalMatsMade</p>
                                GFG;
                                ?>




                               </div>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-3">
                              <h3 style="padding: 14px;margin-top: 16px; text-align: left;">Feedbacks from Learners</h3>

                              <div class="card-group" style="text-align: left;">

                                <?php

                                retrieveLearnerFeedback($conn);
                                retrieveLearners($conn);

                                foreach ($_SESSION['learnerFeedback'][0] as $key) {
                                  // echo '<pre>'; print_r($key); echo '</pre>';
                                  $learnerID = $key['learner_fid'];
                                  $courseFID = $key['course_fid'];
                                  $message = $key['message'];
                                  $courseName = "";

                                  foreach ($_SESSION['singleTeacherCourse'][0] as $thisArray) {
                                    $courseTempName = $thisArray['course_name'];
                                    $courseID = $thisArray['course_id'];
                                    $courseTeacherFID = $thisArray['t_fid'];
                                    if ($courseID == $courseFID && $courseTeacherFID == $_SESSION['teacherid']){
                                      $courseName = $courseTempName;

                                      $counter =0;
                                      foreach ($_SESSION['learnerList'][0] as $var) {
                                        $lID = $var['l_ID'];
                                        $learnerName = $var['l_name'];
                                        $learnerUsername = $var['l_username'];

                                        if ($learnerID == $lID && $courseFID == $courseID){
                                          echo <<<GFG
                                                  <div class="card" style="padding: 24px;" id="learner{$lID}">
                                                    <div>
                                                        <h4 style="padding: 12px 0px;"><strong>${courseName}</strong></h4>
                                                        <h4>Learner's Name: &nbsp&nbsp${learnerName}</h4>
                                                        <h6><i>Username: &nbsp&nbsp${learnerUsername}</i></h6>
                                                    </div>
                                                    <div style ="margin-top: 20px; background-color: rgba(169, 169, 169, 0.1); padding: 24px;">
                                                        <pre>${message}</pre>
                                                    </div>

                                                    <input id= "showFeedbackBox{$counter}" class="simpleTextEdit" type="button" style="margin: 14px 0px; color:green;" value="Reply Feedback" ></input>
                                                    <div id="feedbackBox{$counter}" class="modal">

                                                    <div class="modal-content">
                                                      <div>
                                                          <h4 style=" padding: 24px; text-align: center !important; display: inline-block;">Replying to <strong>{$learnerName}</strong></h4>
                                                          <span style=" display: inline-block;text-align: right; padding: 18px; margin-right: 14px;" id="close{$counter}" class="close">&times;</span>
                                                      </div>

                                                      <form style="all: revert; padding: 24px;" method="post" action="includes/feedbacks.inc.php">
                                                        <div>
                                                            <textarea name="teacherMsg" style="width: 100%; height: 200px;"></textarea>
                                                        </div>
                                                        <div>
                                                            <input type="hidden" name="hiddenCourseID" value="{$courseID}">
                                                            <input type="hidden" name="hiddenLearnerID" value="{$lID}">

                                                            <input type="submit" class="btn btn-primary myhover" name="teacherLearnerFeedback" style="margin-top: 24px; float: right; border-radius: 7px;background: #1eb53a;"></input>
                                                        </div>
                                                      </form>
                                                    </div>

                                                    </div>

                                                    <script>
                                                          var modal{$counter} = document.getElementById("feedbackBox{$counter}");

                                                          // Get the button that opens the modal
                                                          var show{$counter} = document.getElementById("showFeedbackBox{$counter}");

                                                          // Get the <span> element that closes the modal
                                                          var close{$counter} = document.getElementById("close{$counter}");

                                                          // When the user clicks on the button, open the modal
                                                          show{$counter}.onclick = function() {
                                                            modal{$counter}.style.display = "block";
                                                          }

                                                          // When the user clicks on <span> (x), close the modal
                                                          close{$counter}.onclick = function() {
                                                            modal{$counter}.style.display = "none";
                                                          }

                                                    </script>

                                                  </div>



                                          GFG;
                                        }
                                        $counter ++;

                                      }
                                    }

                                  }

                                }

                                 ?>
                               </div>
                                 <h3 style="padding: 14px; margin-top: 16px; text-align: left;">Your Feedbacks Reply</h3>

                                 <div class="card-group" style="text-align: left;">

                                     <?php //IN PROGRESS
                                     retrieveTeacherLearnerFeedback($conn);
                                     retrieveLearners($conn);
                                     foreach ($_SESSION['teacherLearnerFeedback'][0] as $key) {
                                       // echo '<pre>'; print_r($key); echo '</pre>';
                                       $thisTeacherID = $key['submit_teacher_fid'];
                                       $learnerID = $key['receive_learner_fid'];
                                       $courseFID = $key['course_fid'];
                                       $message = $key['message'];
                                       $courseName = "";
                                       $learnername = "";


                                       foreach ($_SESSION['GlobalCourse'][0] as $thisArray) {
                                         $courseTempName = $thisArray['course_name'];
                                         $courseID = $thisArray['course_id'];
                                         if ($courseID == $courseFID){
                                           $courseName = $courseTempName;
                                           break;
                                         }

                                       }
                                       foreach ($_SESSION['learnerList'][0] as $var) {
                                         $lID = $var['l_ID'];
                                         $templearnerName = $var['l_name'];
                                         $learnerUsername = $var['l_username'];

                                         if ($learnerID == $lID){
                                           $learnername = $templearnerName;
                                           break;
                                         }

                                       }

                                       if ($thisTeacherID == $_SESSION['teacherid']){
                                               echo <<<GFG

                                                       <div class="card">
                                                       <span style="text-align: left;">
                                                         <h3 class="subjectList" style="display: inline-block; padding: 10px 24px; text-align: left; margin: 8px 0px;"><strong>{$courseName}</strong></h3>
                                                         <input class="simpleTextCancel" type="button" style="transition: 0.1s; padding-right: 24px; margin: 18px 0px;background-color:inherit;" value = "Remove" onclick="redirectRemoveTLFeedback({$courseFID},{$lID},'{$message}')"></input>

                                                         <h4 class="subjectList" style="; padding: 0px 36px; text-align: left; margin: 8px 0px;">Replied to: &nbsp&nbsp{$learnername}</h4>


                                                         <div style="margin: 0px 36px; margin-bottom: 24px;background-color: rgba(169, 169, 169, 0.1); padding: 24px;">
                                                             <pre>{$message}</pre>
                                                         </div>
                                                       </span>
                                                       </div>



                                               GFG;
                                       }

                                     }





                                      ?>
<!--
                                <div class="card" style="padding: 24px;" id="coursetitle{$tempCourseId}">
                                  <p>Content for tab 3.</p>
                                  <div><p>test</p></div>
                                  <div><p>test</p></div>
                                </div>

                                <div class="card" style="padding: 24px;" id="coursetitle{$tempCourseId}">
                                  <p>Content for tab 3.</p>
                                  <div><p>test</p></div>
                                  <div><p>test</p></div>
                                </div>
                                 -->
                              </div>
                              <h3 style="padding: 14px; margin-top: 16px; text-align: left;">Your Course Feedbacks</h3>

                              <div class="card-group" style="text-align: left;">

                                <?php

                                retrieveTeacherFeedback($conn);

                                foreach ($_SESSION['teacherFeedback'][0] as $key) {
                                  // echo '<pre>'; print_r($key); echo '</pre>';
                                  $teacherid = $key['submit_teacher_fid'];
                                  $courseFID = $key['course_fid'];
                                  $message = $key['message'];
                                  $courseName = "";

                                  if ($teacherid == $_SESSION['teacherid']){

                                  foreach ($_SESSION['GlobalCourse'][0] as $thisArray) {
                                    $courseTempName = $thisArray['course_name'];
                                    $courseID = $thisArray['course_id'];
                                    $courseTeacherFID = $thisArray['t_fid'];
                                    if ($courseID == $courseFID){
                                      $courseName = $courseTempName;


                                      // foreach ($_SESSION['learnerList'][0] as $var) {
                                      //   $lID = $var['l_ID'];
                                      //   $learnerName = $var['l_name'];
                                      //   $learnerUsername = $var['l_username'];
                                      //
                                      //   if ($learnerID == $lID && $courseFID == $courseID){
                                          echo <<<GFG
                                                  <div class="card" style="padding: 24px;" id="learner{$lID}">
                                                    <div>
                                                        <h4 style="display: inline-block; padding: 12px 0px;"><strong>{$courseName}</strong></h4>
                                                        <input class="simpleTextCancel" type="button" style="transition: 0.1s; padding-right: 24px; margin: 16px 0px;background-color:inherit;" value = "Remove" onclick="redirectRemoveFeedback({$courseFID},{$teacherid})"></input>

                                                    </div>
                                                    <div style ="margin-top: 20px; background-color: rgba(169, 169, 169, 0.1); padding: 24px;">
                                                        <pre>{$message}</pre>
                                                    </div>

                                                  </div>



                                          GFG;
                                      //   }
                                      //
                                      // }
                                    }

                                  }
                                  }
                                }

                                 ?>
                               </div>
                               <h3 style="padding: 14px; margin-top: 16px; text-align: left;">Feedbacks from Teachers</h3>

                               <div class="card-group" style="text-align: left;">

                                 <?php

                                 retrieveTeacherFeedback($conn);

                                 foreach ($_SESSION['teacherFeedback'][0] as $key) {
                                   // echo '<pre>'; print_r($key); echo '</pre>';
                                   $teacherid = $key['submit_teacher_fid'];
                                   $courseFID = $key['course_fid'];
                                   $message = $key['message'];
                                   $courseName = "";

                                   if ($teacherid !== $_SESSION['teacherid']){

                                   foreach ($_SESSION['GlobalCourse'][0] as $thisArray) {
                                     $courseTempName = $thisArray['course_name'];
                                     $courseID = $thisArray['course_id'];
                                     $courseTeacherFID = $thisArray['t_fid'];
                                     if ($courseID == $courseFID && $courseTeacherFID == $_SESSION['teacherid']){
                                       $courseName = $courseTempName;


                                       // foreach ($_SESSION['learnerList'][0] as $var) {
                                       //   $lID = $var['l_ID'];
                                       //   $learnerName = $var['l_name'];
                                       //   $learnerUsername = $var['l_username'];
                                       //
                                       //   if ($learnerID == $lID && $courseFID == $courseID){
                                           echo <<<GFG
                                                   <div class="card" style="padding: 24px;" id="teacher{$teacherid}">
                                                     <div>
                                                         <h4 style="display: inline-block; padding: 12px 0px;"><strong>{$courseName}</strong></h4>


                                                     </div>
                                                     <div style ="margin-top: 20px; background-color: rgba(169, 169, 169, 0.1); padding: 24px;">
                                                         <pre>{$message}</pre>
                                                     </div>

                                                   </div>



                                           GFG;
                                       //   }
                                       //
                                       // }
                                     }

                                   }
                                   }
                                 }

                                  ?>
                                <!-- <div class="card" style="padding: 24px;" id="coursetitle{$tempCourseId}">
                                  <h3>Your feedbacks</h3>
                                  <p>Content for tab 3.</p>
                                </div> -->

                                   <!-- <p>Content for tab 3.</p> -->
                                       </div>
                                   </div>
                                  <!-- <div class="card" style="padding: 24px;" id="coursetitle{$tempCourseId}">
                                    <h3>Your feedbacks</h3>
                                    <p>Content for tab 3.</p>
                                  </div> -->
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
</main>
<!-- <section class="portfolio-block website gradient">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-5 offset-lg-1 text">
                <h3>Website Project</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget velit ultricies, feugiat est sed, efr nunc, vivamus vel accumsan dui. Quisque ac dolor cursus, volutpat nisl vel, porttitor eros.</p>
            </div>
            <div class="col-md-12 col-lg-5">
                <div class="portfolio-laptop-mockup">
                    <div class="screen">
                        <div class="screen-content" style="background-image:url(&quot;assets/img/tech/image6.png&quot;);"></div>
                    </div>
                    <div class="keyboard"></div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<footer class="page-footer">
    <div class="container">
        <!-- <div class="links"><a href="#">Contact us</a></div> -->
        <!-- <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div> -->
    </div>
</footer>

    <script>

    var jsTeacherID = '<?php echo $_SESSION["teacherid"]; ?>';
    window.onload = function(){
      // amplify.store("initialSubCount",length);
      onlyTeacherSpecificDisplay(jsTeacherID);

    }
    var emptyelement =document.getElementById("collapseCourse-0");

    if (typeof(emptyelement)!= 'undefined' && emptyelement != null){
      document.getElementById("courseemptyNotice").style.display = "none";
    }else{
      document.getElementById("courseemptyNotice").style.display = "block";
    }


    function cultivateButton(glosubtopiccount){
      // if (document.getElementsByClassName("singleSubjectRow").length == 0){
      //   document.getElementById("emptyNotice").style.display = "block";
      // }
      // else{
      //   document.getElementById("emptyNotice").style.display = "none";
      // }

      if (glosubtopiccount == 0){
        document.getElementById("emptyNotice").style.display = "block";
      }
      else{
        document.getElementById("emptyNotice").style.display = "none";
      }
      // console.log(document.getElementsByClassName("singleSubjectRow"));
    }

    function styleSubjectRow(){
      var row = document.getElementsByClassName("singleSubjectRowLine");
      var togglerow = document.getElementsByClassName("singleSubjectRow");
      // console.log(row);
      for (var i=0; i< togglerow.length-1; i++){
        if (togglerow[i].style.display === "block"){
          row[i].classList.toggle("botBorder");
          document.getElementById("emptyNotice").style.display = "none";


        }
        else {
          document.getElementById("emptyNotice").style.display = "block";
        }

      }
    }

    function onlyTeacherSpecificDisplay(jsTeacherID){
      // var templength = amplify.store("initialSubCount");
      // console.log(row.length);
      var row = document.getElementsByClassName("singleSubjectRow");
      var length = row.length;
      var glosubtopiccount = 0;
      for (var i=0; i< length; i++){
        // console.log(row[i].childNodes);
        var row1 = row[i].children;
        var subtopiccount = 0;
        // console.log(length);


        for (var j=0; j< row1.length; j++){
          var row2 = row1[j].children;
          // console.log(row2);
          for (var k=0; k< row2.length; k++){
            var row3 = row2[k].children;
            for (var m=0; m< row3.length; m++){
              var row4 = row3[m].children;
              // console.log(row4);
              for (var p=0; p< row4.length; p++){
                var row5 = row4[p].children;

                if (row5[0].classList.contains(`teacheridIs_${jsTeacherID}`)== true){
                  // row[i].style.display = "block";
                  // console.log("row is "+ row4[p].id);
                  var tempeditID = row4[p].id;
                  createSubtopicEdit(tempeditID);

                  subtopiccount +=1;
                  glosubtopiccount +=1;

                }else {
                  // row[i].style.display = "none";
                  // console.log("none the i is "+i);
                }

                if (subtopiccount > 0){
                  row[i].style.display = "block";
                }
                else {
                  row[i].style.display = "none";
                }
                // console.log(subtopiccount);

                // console.log(row5[0].classList.contains(`teacheridIs_${jsTeacherID}`));
                // console.log(length);

                // for (var q=0; q< row5.length; q++){
                //   var row6 = row5[q].children;
                //   console.log(row6);
                // }
              }
            }
          }
        }

        // console.log(row1[i].childNode);
        // if row.children[i].classList.contains(`teacheridIs_${jsTeacherID}`){
        //   row[i].style.display = "block";
        // }else {
        //   row[i].style.display = "none";
        // }
      }
      styleSubjectRow();
      cultivateButton(glosubtopiccount);


    }
    function createSubtopicEdit(tempeditID){
      var subtopicID = document.getElementById(tempeditID).id;
      var edit = document.createElement("input");

      edit.setAttribute("id", `editfor${subtopicID}`);

      edit.setAttribute("type", "button");

      edit.setAttribute("onclick", `redirectEdit("${subtopicID}")`);

      edit.setAttribute("class", "simpleTextEdit");

      edit.setAttribute("name", "Edit");

      edit.setAttribute("value", "Edit");

      //append to form element that you want .
      document.getElementById(`${tempeditID}`).appendChild(edit);

      // if (document.getElementById("getExistingSubID") !== null){
      //   document.getElementById("getExistingSubID").value = subjectID;
      // }
      // console.log(document.getElementById(`${tempeditID}`).id);
      console.log(subtopicID);

    }
    function redirectEdit(subtopicID){ //to enable setting up form in editor
      window.location.href=`teacheredit.php?editsubtopics=${subtopicID}`;
    }
    function redirectDelete(matID){ //delete the Material Entry
      window.location.href=`includes/newmat.inc.php?deletemat=${matID}`;
    }
    function redirectEditCourse(tempCourseId){ //to enable editing of the selected course
      window.location.href=`teachercourseedit.php?editcourse=${tempCourseId}`;
    }
    function redirectViewCourse(tempCourseId){ //to enable editing of the selected course
      window.location.href=`display.php?course=${tempCourseId}`;
    }
    function redirectDeleteCourse(tempCourseId){ //to enable editing of the selected course
      window.location.href=`includes/coursenew.inc.php?delete=${tempCourseId}`;
    }
    function redirectView(subtopicID){ //to display the preview of the material
      window.location.href=`display.php?subtopic=${subtopicID}`;
    }
    function redirectAddNewMatIn(subtopicID){ //to redirect to adding materials in the selected subtopic
      window.location.href=`matedit.php?subtopic=${subtopicID}`;
    }
    function redirectRemoveFeedback(courseID, teacherID){ //to redirect to adding materials in the selected subtopic
      window.location.href=`includes/feedbacks.inc.php?remove=${courseID}&teacher=${teacherID}`;
    }
    function redirectRemoveTLFeedback(courseID, learnerID, message){ //to redirect to adding materials in the selected subtopic
      window.location.href=`includes/feedbacks.inc.php?remove=${courseID}&learner=${learnerID}&msg=${message}`;
    }


    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/overlay.js"></script>
    <script src="assets/js/pickavatar.js"></script>
    <script src="assets/js/preventclick.js"></script>
    <script src="assets/js/Sidebar-Menu.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
