<?php
  include_once 'teacherheader.php';

  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  // headlesstaillessretrieveSubjects($conn);
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
                        <div class="col d-xxl-flex align-items-xxl-center">
                          <div>
                            <?php
                             echo '<h1 class="d-xxl-flex justify-content-xxl-start">' . "$_SESSION[username]" . '</h1><small class="d-xxl-flex justify-content-xxl-start">Pick a nickname</small>';

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
                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">nil</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Achievements</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="tab-1">
                                <div class="accordion" role="tablist" id="accordion-1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1">My Courses</button></h2>
                                        <div class="accordion-collapse collapse show item-1 text-start" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                              <?php
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
                                                        <a class="simpleTextEdit" style="margin: 14px 0px;" href="teachercourseedit.php?editcourse={$tempCourseId}">Edit</a>
                                                          <div class="collapse" id="collapseCourse-{$num}">

                                                 GFG;
                                                    //DISPLAY ORDERED SUBTOPICS
                                                    $subsnum = 0;
                                                    foreach ($_SESSION["singleTeacherCourseSubtopics"] as $coursesubsDisp){
                                                      $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
                                                      $tempTopSubname = $coursesubsDisp[$subsnum];
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
                                                                <a class="btn btn-primary listgroupdropMain TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subsnum}" href="#collapseTopic-{$subsnum}" role="button">{$tempSubname}</a>

                                                          GFG;


                                                          echo <<<GFG



                                                                  </div>
                                                          GFG;
                                                          $innercount += 1;
                                                        }
                                                        }

                                                      $subsnum +=1;
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

                                                  <div><a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="teachercourseedit.php">Tinker a New Course!</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">My Materials</button></h2>
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
                                                                      <button class="btn btn-primary listgroupdropMain SubtopicList teacheridIs_{$tempSubtopicTeacherId}" style="margin-left: 56px; margin-top: -8px; margin-bottom: 6px; background-color:white; color:black;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subtopicnum}" href="#collapseSubtopic-{$subtopicnum}" ><i>{$tempSubtopicname}</i></button>
                                                                        <div class="collapse" id="collapseSubtopic-{$subtopicnum}">


                                                                            </div>
                                                                        </div>
                                                                GFG;
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
                                               </div>
                                                 <a class="btn btn-primary" style="margin-top: 12px; margin-left: 10px;border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something new!</a>
                                               </div>
                                        </div>
                                    </div>
                                  </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">Accordion Item</button></h2>
                                        <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                                <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-2">
                                <p>Content for tab 2.</p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-3">
                                <p>Content for tab 3.</p>
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
<section class="portfolio-block website gradient">
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
</section>
<footer class="page-footer">
    <div class="container">
        <div class="links"><a href="#">Contact us</a></div>
        <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
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
