<?php
  include_once 'teacherheader.php';
  invalidUserAcess();
?>

    <main class="page lanidng-page">
        <section class="editor" style="background: rgba(212,255,162,0.31);">
            <div class="row" style="width: 1300px;margin: auto;">
                <div class="col" style="width: 1300px;margin: auto;">
                    <h1 style="margin: auto;">Study Cultivation</h1>
                    <div class="row">
                        <div class="col"><small><strong>Create </strong>&amp;&nbsp;<strong>Edit</strong> Subjects, Topics and Subtopics!&nbsp;</small></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="editor">
            <div class="col">
                <form id="teachereditorform" method="post" action="includes/teachersubmitedit.inc.php">
                    <div class="row">
                        <div class="col-xxl-4" style="padding: 0px 56px;padding-top: 16px;">
                            <div class="row">
                                <div class="col" style="padding: 0px;border-top-width: 1px;border-top-style: solid;border-bottom-width: 1px;border-bottom-style: solid;">

                                          <?php
                                          if(isset($_GET['editsubtopics'])){
                                            $tempExistingSubtopicID = $_GET['editsubtopics'];
                                            //replacing buttons with perma title
                                            //
                                            //
                                            // foreach ($_SESSION["teachersubjectsCombined"][$num] as $display) {
                                            //   $tempname = $display['sbjt_name'];
                                            //   $tempdesc = $display['sbjt_desc'];
                                            //   $tempSubId = $display['sbjt_id'];
                                            //
                                            //   $num += 1;
                                            //
                                            // }

                                            echo <<<GFG

                                              <div class="dropdown">
                                              <h4 class="" style="margin: 8px 0px; padding: 6px 16px;">Subject</h4>
                                                  <div class="dropdown-menu" id="dropmenuboxSubj" >

                                            GFG;

                                          } else {

                                            echo <<<GFG
                                              <div class="dropdown"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuSubj" aria-expanded="false" data-bs-toggle="dropdown" type="button">Subjects</button>
                                                  <div class="dropdown-menu" id="dropmenuboxSubj" >

                                            GFG;

                                          $num = 0;
                                          foreach ($_SESSION["teachersubjectsCombined"][$num] as $display) {
                                            $tempname = $display['sbjt_name'];
                                            $tempdesc = $display['sbjt_desc'];
                                            $tempSubId = $display['sbjt_id'];
                                            echo <<<GFG
                                              <input type='button' class='dropdown-item' id='subject{$num}' onclick="setSubjectDisplay('{$tempname}', '{$tempdesc}', {$tempSubId})" value = '{$tempname}'>

                                            GFG;
                                            $num += 1;

                                          }
                                        }
                                          echo "<input type='button' class='dropdown-item' id='menuNewsubject' onclick=\"newSubj()\" value = ' ➕ New Subject'>";

                                           ?>
                                          <!-- <a class="dropdown-item" href="#">First Item</a>
                                          <a class="dropdown-item" href="#">Second Item</a>
                                          <a class="dropdown-item" href="#">Third Item</a> -->
                                        </div>

                                    </div>
                                    <?php
                                    if(isset($_GET['editsubtopics'])){
                                      $tempExistingSubtopicID = $_GET['editsubtopics'];

                                      echo <<<GFG

                                        <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" required="" readonly="">
                                        <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" required="" readonly=""></textarea>

                                      GFG;

                                    }else{
                                      echo <<<GFG

                                        <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" required="" readonly="">
                                        <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" required="" readonly=""></textarea>

                                      GFG;

                                    }


                                     ?>
                                    <!-- <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" required="" readonly="">
                                    <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" required="" readonly=""></textarea> -->
                            </div>
                          </div>
                            <div class="row">
                                <div class="col" style="padding: 0px;border-top-width: 0.5px;border-bottom-width: 1px;border-bottom-style: solid;">

                                          <?php
                                          if(isset($_GET['editsubtopics'])){
                                            $tempExistingSubtopicID = $_GET['editsubtopics'];

                                            echo <<<GFG
                                                <input id="hiddenExistingSubtopicID" type="hidden" name="hiddenExistingSubtopicID" value ={$tempExistingSubtopicID}>
                                            GFG;
                                            //
                                            // $num = 0;
                                            // foreach ($_SESSION["teachertopicsCombined"][$num] as $display) {
                                            //   $tempname = $display['topic_name'];
                                            //   $tempdesc = $display['topic_desc'];
                                            //   $tempSubFId = $display['sbjt_fid'];
                                            //   $tempTopicId = $display['topic_id'];
                                            //
                                            //   $num += 1;
                                            // }

                                            echo <<<GFG
                                              <div class="dropdown">
                                              <h4 class="" style="margin: 8px 0px; padding: 6px 16px;">Topic</h4>
                                                  <div class="dropdown-menu" id="dropmenuboxSubj" >

                                            GFG;

                                          } else {

                                            echo <<<GFG
                                              <div class="dropdown" style="border-top-width: 0px;"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuTopic" aria-expanded="false" data-bs-toggle="dropdown" type="button">Topics</button>
                                                <div class="dropdown-menu" id="dropmenuboxTopics">

                                            GFG;



                                          $num = 0;
                                          foreach ($_SESSION["teachertopicsCombined"][$num] as $display) {
                                            $tempname = $display['topic_name'];
                                            $tempdesc = $display['topic_desc'];
                                            $tempSubFId = $display['sbjt_fid'];
                                            $tempTopicId = $display['topic_id'];
                                            echo <<<GFG
                                              <input type='button' class='dropdown-item dropdownTopics subjectFIDis{$tempSubFId}' id='topic{$num}' style='display:none;' onclick="setTopicDisplay('{$tempname}', '{$tempdesc}', '{$tempTopicId}')" value = '{$tempname}'>
                                            GFG;

                                            $num += 1;
                                          }
                                        }
                                          echo "<input type='button' class='dropdown-item dropdownNewTopic' id='menuNewtopic' style='display:none;' onclick=\"newTopic()\" value = ' ➕ New Topic'>";

                                           ?>
                                        </div>
                                      </div>
                                          <input class="form-control sidetitles" type="text" required="" readonly="" id="topicname" name="topicname" placeholder="Topic Title">
                                          <textarea class="form-control sidetitles" required="" readonly="" id="topicdesc" name="topicdesc" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col" style="padding: 0px;border-top-width: 0.5px;border-bottom-width: 1px;border-bottom-style: solid;">
                                      <input type='button' class='dropdown-item' disabled = "" style="text-decoration:underline" value = 'Existing Subtopics'>
                                      <input id = "miniSelect" type='button' class='dropdown-item' style="padding-bottom: 8px; font-size: 14px; font-style:italic;" disabled = "" value = 'Select a subject and a topic first'>
                                      <div id = "rowForExistingSubtopics">

                                              <?php


                                              $num = 0;
                                              foreach ($_SESSION["teachersubtopicsCombined"][$num] as $display) {
                                                $tempname = $display['sub_name'];
                                                $tempdesc = $display['sub_desc'];
                                                $tempSubtopicId = $display['sub_id'];
                                                $tempTopicFId = $display['topic_fid'];
                                                echo <<<GFG
                                                  <input type='button' class='blankbutton dropdown-item dropdownSubtopics topicFIDis{$tempTopicFId}' id='subtopic{$tempSubtopicId}' style='display:none;'  value = '{$tempname}'>
                                                GFG;

                                                $num += 1;


                                              }


                                               ?>
                                             </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="col" style="height: 900px;padding: 0px 40px;border-left-width: 1px;border-left-style: solid;margin: 14px 0px;">
                          <label class="form-label middlelabel biggerlabel">Subtopic Title</label>
                          <input id="subtopicname" class="form-control" type="text" name="subtopicname" required="">
                          <label class="form-label middlelabel biggerlabel">Description</label>
                          <textarea id="subtopicdesc" class="form-control" name="subtopicdesc" style="height: 200px;" required=""></textarea>
                          <div>
                            <button class="btn btn-primary" type="submit" name="submitSub" style="margin-top: 24px; float: right; border-radius: 7px;background: #1eb53a;">Send In!</button>
                            <input class="simpleTextCancel" type="reset" onclick="destroySubtopics()" value="Cancel Changes" style="padding: 6px 16px; float: right; margin-top: 24px; background: #FFFFFF; border: 0px;">
                            <input id="hiddenTotalCount" type="hidden" name="hiddenTotalCount" value =0>
                          </div>
                        </div>
                    </div>
                </form>
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
    var subcount = 0;
    var topiccount = 0;
    var totalcount = subcount + topiccount;
    function setSubjectDisplay(displaySubject, displayDesc, subjectID){
        // console.log(displaySubject);
        document.getElementById("subjectname").value = displaySubject;
        document.getElementById("subjectdesc").value = displayDesc;
        document.getElementById("subjectname").readOnly = true;
        document.getElementById("subjectdesc").readOnly = true;
        document.getElementById("menuNewtopic").style.display = "block";

        subcount = 0;
        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);
        getExistingSubID(subjectID);

        var element = document.getElementById("dropmenuSubj"); //tweaking the behavior of dropdown menu
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");

        var element2 = document.getElementById("dropmenuboxSubj"); //tweaking the behavior of dropdown menu
        element2.classList.toggle("show");

        destroySubtopics();

        var elementfid = document.getElementsByClassName("dropdownTopics"); //making the topics to be dependant on the parent subjects
        // console.log(elementfid[0].className);
        for (var i = 0; i <= elementfid.length; i++) {
          // console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`subjectFIDis${subjectID}`) == true){
            // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
            elementfid[i].style.display = "block";
          }
          else{
            elementfid[i].style.display = "none";
            // console.log(elementfid[i].display);
            document.getElementById("topicname").value = "";
            document.getElementById("topicdesc").value = "";
            document.getElementById("topicname").readOnly = true;
            document.getElementById("topicdesc").readOnly = true;


          }
        }
      }

      function systemSetSubjectDisplay(displaySubject, displayDesc, subjectID){
          // console.log(displaySubject);
          document.getElementById("subjectname").value = displaySubject;
          document.getElementById("subjectdesc").value = displayDesc;
          document.getElementById("subjectname").readOnly = true;
          document.getElementById("subjectdesc").readOnly = true;
          document.getElementById("menuNewtopic").style.display = "block";

          subcount = 0;
          topiccount = 1;
          document.getElementById("hiddenTotalCount").value = subcount+topiccount;
          console.log("count is " + document.getElementById("hiddenTotalCount").value);
          getExistingSubID(subjectID);

        }

      function getExistingSubID (subjectID){
        var input = document.createElement("input");

        input.setAttribute("id", "getExistingSubID");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "getExistingSubID");

        input.setAttribute("value", subjectID);

        //append to form element that you want .
        document.getElementById("teachereditorform").appendChild(input);

        if (document.getElementById("getExistingSubID") !== null){
          document.getElementById("getExistingSubID").value = subjectID;
        }
        console.log(document.getElementById("getExistingSubID").value);


      }

      function newSubj(){
        document.getElementById("subjectname").value = "";
        document.getElementById("subjectdesc").value = "";
        document.getElementById("subjectname").readOnly = false;
        document.getElementById("subjectdesc").readOnly = false;
        document.getElementById("menuNewtopic").style.display = "block";
        destroySubtopics();

        var element = document.getElementById("dropmenuSubj");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxSubj");
        element2.classList.toggle("show");

        if (document.getElementById("getExistingSubID") !== null){
          document.getElementById("getExistingSubID").value = null;
        }
        console.log(document.getElementById("getExistingSubID"));
        subcount = 1;
        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);



        var elementfid = document.getElementsByClassName("dropdownTopics");
        // console.log(elementfid[0].className);
        // console.log("hello");
        for (var i = 0; i <= elementfid.length; i++) {

            elementfid[i].style.display = "none";
            document.getElementById("topicname").value = "";
            document.getElementById("topicdesc").value = "";
            document.getElementById("topicname").readOnly = true;
            document.getElementById("topicdesc").readOnly = true;

        }
        // var showNewTopic = document.getElementById("menuNewtopic");
        // showNewTopic.style.display = "block";
        // console.log(showNewTopic.style.display);
      }

      function setTopicDisplay(displayTopic, displayDesc, topicID){
        // console.log(displayTopic);
        // console.log(displayDesc);
        document.getElementById("topicname").value = displayTopic;
        document.getElementById("topicdesc").value = displayDesc;
        document.getElementById("topicname").readOnly = true;
        document.getElementById("topicdesc").readOnly = true;

        subcount = 0;
        topiccount = 0;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);

        getExistingTopicID(topicID);
        console.log(document.getElementById("getExistingSubID").value);
        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");

        document.getElementById("rowForExistingSubtopics").style.display = "block";
        document.getElementById("miniSelect").style.display = "none";


        var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
        // console.log(elementfid[0].className);
        for (var i = 0; i <= elementfid.length; i++) {
          // console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
            // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
            elementfid[i].style.display = "block";
          }
          else{
            elementfid[i].style.display = "none";
            // console.log(elementfid[i].display);
            // document.getElementById("topicname").value = "";
            // document.getElementById("topicdesc").value = "";
            // document.getElementById("topicname").readOnly = true;
            // document.getElementById("topicdesc").readOnly = true;

          }
        }
      }

      function systemSetTopicDisplay(displayTopic, displayDesc, topicID, subtopicId){
        // console.log(displayTopic);
        // console.log(displayDesc);
        document.getElementById("topicname").value = displayTopic;
        document.getElementById("topicdesc").value = displayDesc;
        document.getElementById("topicname").readOnly = true;
        document.getElementById("topicdesc").readOnly = true;

        subcount = 0;
        topiccount = 0;
        document.getElementById("hiddenTotalCount").value = 3; //for CASE SELECTION IN PHP
        console.log("count is " + document.getElementById("hiddenTotalCount").value);

        getExistingTopicID(topicID);
        console.log(document.getElementById("getExistingSubID").value);
        // var element = document.getElementById("dropmenuTopic");
        // element.setAttribute('aria-expanded', 'false');
        // element.classList.toggle("show");
        // var element2 = document.getElementById("dropmenuboxTopics");
        // element2.classList.toggle("show");

        document.getElementById("rowForExistingSubtopics").style.display = "block";
        document.getElementById("miniSelect").style.display = "none";
        //
        //
        var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
        // console.log(elementfid[0].className);
        for (var i = 0; i <= elementfid.length; i++) {
          // console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
            // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
            elementfid[i].style.display = "block";
            if (elementfid[i].id == subtopicId){
              elementfid[i].classList.add("highlightThis");
            }

          }
          else{
            elementfid[i].style.display = "none";
            // console.log(elementfid[i].display);
            // document.getElementById("topicname").value = "";
            // document.getElementById("topicdesc").value = "";
            // document.getElementById("topicname").readOnly = true;
            // document.getElementById("topicdesc").readOnly = true;

          }
        }
      }

      function getExistingTopicID (topicID){
        var input = document.createElement("input");

        input.setAttribute("id", "getExistingTopicID");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "getExistingTopicID");

        input.setAttribute("value", topicID);

        //append to form element that you want .
        document.getElementById("teachereditorform").appendChild(input);

        if (document.getElementById("getExistingTopicID") !== null){
          document.getElementById("getExistingTopicID").value = topicID;
        }
        console.log(document.getElementById("getExistingTopicID"));


      }

      function newTopic(){
        document.getElementById("topicname").value = "";
        document.getElementById("topicdesc").value = "";
        document.getElementById("topicname").readOnly = false;
        document.getElementById("topicdesc").readOnly = false;

        destroySubtopics();

        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);

        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");

        if (document.getElementById("getExistingTopicID") !== null){
          document.getElementById("getExistingTopicID").value = null;
        }
        console.log(document.getElementById("getExistingSubID").value);
        console.log(document.getElementById("getExistingTopicID"));



      }
      function destroySubtopics(){
        document.getElementById("rowForExistingSubtopics").style.display = "none";
        document.getElementById("miniSelect").style.display = "block";

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
<?php
if(isset($_GET['editsubtopics'])){
  $tempExistingSubtopicID = $_GET['editsubtopics'];

  $num = 0;
  foreach ($_SESSION["teachersubjectsCombined"][$num] as $subdisplay) {
    $tempSubname = $subdisplay['sbjt_name'];
    $tempSubdesc = $subdisplay['sbjt_desc'];
    $tempSubId = $subdisplay['sbjt_id'];

    $num += 1;

    $topicnum = 0;
    foreach ($_SESSION["teachertopicsCombined"][$topicnum] as $topicdisplay) {
      $tempTopicname = $topicdisplay['topic_name'];
      $tempTopicdesc = $topicdisplay['topic_desc'];
      $tempSubFId = $topicdisplay['sbjt_fid'];
      $tempTopicId = $topicdisplay['topic_id'];

      $topicnum += 1;

      $subtnum = 0;
      foreach ($_SESSION["teachersubtopicsCombined"][$subtnum] as $subtopicdisplay) {
        $tempSubtopicname = $subtopicdisplay['sub_name'];
        $tempSubtopicdesc = $subtopicdisplay['sub_desc'];
        $tempSubtopicId = $subtopicdisplay['sub_id'];
        $tempTopicFId = $subtopicdisplay['topic_fid'];

        if (($tempExistingSubtopicID == $tempSubtopicId) && ($tempTopicId == $tempTopicFId) && ($tempSubFId == $tempSubId)){
          echo <<<GFG
              <script>
                  systemSetSubjectDisplay("{$tempSubname}","{$tempSubdesc}","{$tempSubId}");

                  document.getElementById("subtopicname").value = "{$tempSubtopicname}";
                  document.getElementById("subtopicdesc").value = `{$tempSubtopicdesc}`;
                  systemSetTopicDisplay("{$tempTopicname}","{$tempTopicdesc}","{$tempTopicId}","subtopic{$tempSubtopicId}");

              </script>


          GFG;
        }

        $subtnum += 1;

      }
    }
  }


}
 ?>
