<?php
  include_once 'header.php';

  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';
  require_once 'includes/display.functions.inc.php';


  // headlesstaillessretrieveSubjects($conn);
  retrieveLearnerCourse($conn);
  retrieveGlobalCourse($conn);
  invalidUserAcess();
?>

    <main class="page lanidng-page">
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-bottom: 50px;background: #ededed;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-3" id="avatar" onclick="on()">
                                <picture style="width: 128px;height: 128px;"><img id="profileavatar" src="assets/img/avatars/avatar.jpg" style="width: 128px;height: 128px;border-radius: 176px;"></picture>
                            </div>
                            <div class="col d-xxl-flex align-items-xxl-center">
                                <div>
                                  <?php
                                   echo '<h1 class="d-xxl-flex justify-content-xxl-start">' . "$_SESSION[username]" . '</h1>';
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
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Courses</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Progress</a></li>
                                <!-- <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Achievements</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="tab-1">
                                    <h1 class="text-start" style="padding: 16px 16px;">My Courses</h1>
                                    <div class="card-group">
                                      <?php
                                      $tempSUBBEDcourseID[] = "";



                                      foreach ($_SESSION["learnerCourse"][0] as $subscribed){

                                        if (empty($subscribed)){
                                          $tempSUBBEDcourseID= "";
                                          // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                        } else {

                                          $tempSUBBEDcourseID[] = $subscribed['course_fid'];
                                          // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                        }
                                      }



                                      $num=0;

                                      //COURSE PART
                                        foreach ($_SESSION["GlobalCourse"][$num] as $display) {
                                          // echo '<pre>'; print_r($display); echo '</pre>';

                                          $tempCourseId = $display['course_id'];
                                          $tempname = $display['course_name'];
                                          $tempdesc = $display['course_desc'];
                                          $tempTFID = $display['t_fid'];
                                          // $tempTID = $_SESSION["teacherid"];
                                          if (in_array($tempCourseId, $tempSUBBEDcourseID)){

                                          echo <<<GFG
                                              <div class="card coursetitle" id="coursetitle{$tempCourseId}">
                                              <span style="text-align: left;">
                                                <h3 class="subjectList" style="display: inline-block; padding: 10px 24px; text-align: left; margin: 8px 0px;"><strong>{$tempname}</strong></h3>

                                                <input class="simpleTextCancel" type="button" style="transition: 0.1s; padding-right: 24px; margin: 18px 0px;background-color:inherit;" value = "Remove" onclick="redirectRemoveSubscription({$tempCourseId})"></input>

                                                <input class="resumebutton" type="button" value="Resume" onclick="redirectResumeCourse({$tempCourseId})"></input>
                                                <div style="margin: auto; margin-bottom: 14px;  width: 90%;border-color: rgba(0,0,0, 50%); border-bottom: 1px solid;"></div>
                                              </span>


                                          GFG;


                                          echo <<<GFG

                                                  <div  id="collapseCourse-{$num}">

                                          GFG;
                                            //DISPLAY ORDERED SUBTOPICS
                                            $subsnum = 0;
                                            foreach ($_SESSION["GlobalCourseSubtopics"] as $coursesubsDisp){
                                              $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
                                              // $tempTopSubname = $coursesubsDisp[$subsnum];
                                              // $tempSubdesc = $coursesubsDisp[$subsnum]['sub_desc'];
                                              // $tempSubFId = $coursesubsDisp['sbjt_fid'];
                                              // $tempTopicId = $coursesubsDisp['topic_id'];
                                              // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                              if($tempCourseId == $tempinnercourse){
                                                // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                                $innercount = 0;
                                                foreach ($coursesubsDisp as $count) {
                                                  $tempSubname = $count['sub_name'];
                                                  echo <<<GFG
                                                      <div class="singleTopicRow" id="singleTopicRow{$subsnum}">
                                                        <p class="TopicList" style="text-align: left;padding-left: 12px; padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;">{$tempSubname}</p>

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
                                      }


                               ?>

                                    </div>

                                    <div class="card"><img class="card-img-top w-100 d-block">
                                      <a class="hoverableCard" href="browse.php" style="background-color: rgba(69,69,69,10%);padding: 48px">
                                        <span class="card-body" style="padding: 48px">
                                            <!-- <h4 class="card-title">Title</h4> -->
                                            <!-- <a href=""> -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-journal-plus" style="font-size: 80px; color: black; display: inline-block;">
                                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"></path>
                                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"></path>
                                                    <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"></path>
                                                </svg>
                                              <!-- </a> -->
                                            <p class="card-text" style="display: inline-block; color: black; padding: 24px;">Add new course.</p>
                                        </span>
                                      </a>

                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab-2">
                                  <h1 class="text-start" style="padding: 16px 16px;">My Progress</h1>
                                    <div class="card-group">

                                      <?php
                                      $tempSUBBEDcourseID;



                                      foreach ($_SESSION["learnerCourse"][0] as $subscribed){

                                        if (empty($subscribed)){
                                          $tempSUBBEDcourseID = "";
                                          // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                        } else {

                                          $tempSUBBEDcourseID[] = $subscribed['course_fid'];
                                          // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                        }
                                      }



                                      $num=0;

                                      //COURSE PART
                                        foreach ($_SESSION["GlobalCourse"][$num] as $display) {
                                          // echo '<pre>'; print_r($display); echo '</pre>';

                                          $tempCourseId = $display['course_id'];
                                          $tempname = $display['course_name'];
                                          $tempdesc = $display['course_desc'];
                                          $tempTFID = $display['t_fid'];
                                          // $tempTID = $_SESSION["teacherid"];
                                          if (in_array($tempCourseId, $tempSUBBEDcourseID)){

                                          echo <<<GFG
                                              <div class="card coursetitle" id="coursetitle{$tempCourseId}">
                                              <span style="text-align: left;">
                                                <h3 class="subjectList" style="display: inline-block; padding: 10px 24px; text-align: left; margin: 8px 0px;"><strong>{$tempname}</strong></h3>

                                                <input class="simpleTextCancel" type="button" style="transition: 0.1s; padding-right: 24px; margin: 18px 0px;background-color:inherit;" value = "Remove" onclick="redirectRemoveSubscription({$tempCourseId})"></input>

                                                <input class="resumebutton" type="button" value="Resume" onclick="redirectResumeCourse({$tempCourseId})"></input>
                                                <div style="margin: auto; margin-bottom: 14px;  width: 90%;border-color: rgba(0,0,0, 50%); border-bottom: 1px solid;"></div>
                                              </span>


                                          GFG;


                                          echo <<<GFG

                                                  <div  id="collapseCourse-{$num}">


                                          GFG;
                                          foreach ($_SESSION["learnerCourse"][0] as $subscribed){
                                            $subscribedDate = $subscribed['subscription_date'];
                                            // $matprogress = count(json_decode($subscribed['material_progress'], true));
                                            // $quizprogress = count(json_decode($subscribed['quiz_progress'], true));
                                            // $tempProgressPercentage = ($matprogress/$quizprogress)*100;
                                            $tempProgressPercentage = $subscribed['total_progress'];
                                            $tempQuizScore = $subscribed['quiz_scores'];




                                                  if ($tempCourseId == $subscribed['course_fid']){
                                                    echo <<<GFG
                                                          <h4>Date Subscribed</h4>
                                                          <p>{$subscribedDate}</p>
                                                          <h4>Current Progress</h4>
                                                          <p>{$tempProgressPercentage}%</p>
                                                          <h4>Quiz Score</h4>
                                                          <p>{$tempQuizScore}%</p>



                                                    GFG;

                                                  }

                                            }




                                             echo <<<GFG

                                                      </div>
                                                  </div>

                                              GFG;
                                          // <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
                                          $num += 1;
                                        }
                                      }


                               ?>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" role="tabpanel" id="tab-3">
                                    <p>Content for tab 3.</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
    </main>

    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script>
    function redirectRemoveSubscription(tempCourseId){ //to allows learner to subscribe to the course
      window.location.href=`includes/subscribetocourse.inc.php?delete=${tempCourseId}`;
    }
    function redirectResumeCourse(tempCourseId){ //to allows learner to subscribe to the course
      window.location.href=`learnerdisplaysession.php?course=${tempCourseId}`;
    }
    </script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/overlay.js"></script>
    <script src="assets/js/pickavatar.js"></script>
    <script src="assets/js/preventclick.js"></script>
    <script src="assets/js/Sidebar-Menu.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
