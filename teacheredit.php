<?php
  include_once 'teacherheader.php';

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
                <form method="post">
                    <div class="row">
                        <div class="col-xxl-4" style="padding: 0px 56px;padding-top: 16px;">
                            <div class="row">
                                <div class="col" style="padding: 0px;border-top-width: 1px;border-top-style: solid;border-bottom-width: 1px;border-bottom-style: solid;">
                                    <div class="dropdown"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuSubj" aria-expanded="false" data-bs-toggle="dropdown" type="button">Subjects</button>
                                        <div class="dropdown-menu" id="dropmenuboxSubj" >
                                          <?php
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
                                          echo "<input type='button' class='dropdown-item' id='subject$num' onclick=\"newSubj()\" value = ' ➕ New Subject'>";

                                           ?>
                                          <!-- <a class="dropdown-item" href="#">First Item</a>
                                          <a class="dropdown-item" href="#">Second Item</a>
                                          <a class="dropdown-item" href="#">Third Item</a> -->
                                        </div>

                                    </div>
                                    <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" disabled="">
                                    <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" disabled=""></textarea>
                            </div>
                          </div>
                            <div class="row">
                                <div class="col" style="padding: 0px;border-top-width: 0.5px;border-bottom-width: 1px;border-bottom-style: solid;">
                                    <div class="dropdown" style="border-top-width: 0px;"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuTopic" aria-expanded="false" data-bs-toggle="dropdown" type="button">Topics</button>
                                        <div class="dropdown-menu" id="dropmenuboxTopics">
                                          <?php
                                          $num = 0;
                                          foreach ($_SESSION["teachertopicsCombined"][$num] as $display) {
                                            $tempname = $display['topic_name'];
                                            $tempdesc = $display['topic_desc'];
                                            $tempSubFId = $display['sbjt_fid'];
                                            echo "<input type='button' class='dropdown-item dropdownTopics subjectFIDis{$tempSubFId}' id='topic{$num}' onclick=\"setTopicDisplay('$tempname', '$tempdesc')\" value = '$tempname'>";
                                            // echo '<pre>'; print_r($result); echo '</pre>';
                                            // echo '<pre>'; print_r($display); echo '</pre>';
                                            $num += 1;


                                          }
                                          echo "<input type='button' class='dropdown-item' id='topic$num' onclick=\"newTopic()\" value = ' ➕ New Topic'>";

                                           ?>
                                        </div>
                                      </div>
                                          <input class="form-control sidetitles" type="text" disabled="" id="topicname" name="topicname" placeholder="Topic Title">
                                          <textarea class="form-control sidetitles" disabled="" id="topicdesc" name="topicdesc" placeholder="Description"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="col" style="height: 900px;padding: 0px 40px;border-left-width: 1px;border-left-style: solid;margin: 14px 0px;">
                          <label class="form-label middlelabel biggerlabel">Subtopic Title</label>
                          <input class="form-control" type="text">
                          <label class="form-label middlelabel biggerlabel">Description</label>
                          <textarea class="form-control" style="height: 200px;"></textarea>
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
      function setSubjectDisplay(displaySubject, displayDesc, subjectID){
        // console.log(displaySubject);
        document.getElementById("subjectname").value = displaySubject;
        document.getElementById("subjectdesc").value = displayDesc;
        document.getElementById("subjectname").disabled = true;
        document.getElementById("subjectdesc").disabled = true;
        var element = document.getElementById("dropmenuSubj");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxSubj");
        element2.classList.toggle("show");
        var elementfid = document.getElementsByClassName("dropdownTopics");
        console.log(elementfid[0].className);//Still INCOMPLETE
        for (var i = 0; i <= elementfid.length; i++) {
          console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`subjectFIDis${subjectID}`) == true){
            console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
          }
          else {
            elementfid[i].display = "none";
            console.log(elementfid[i].display)
          }
        }


      }

      function newSubj(){
        document.getElementById("subjectname").value = "";
        document.getElementById("subjectdesc").value = "";
        document.getElementById("subjectname").disabled = false;
        document.getElementById("subjectdesc").disabled = false;
        var element = document.getElementById("dropmenuSubj");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxSubj");
        element2.classList.toggle("show");
      }

      function setTopicDisplay(displayTopic, displayDesc){
        // console.log(displayTopic);
        // console.log(displayDesc);
        document.getElementById("topicname").value = displayTopic;
        document.getElementById("topicdesc").value = displayDesc;
        document.getElementById("topicname").disabled = true;
        document.getElementById("topicdesc").disabled = true;
        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");

      }

      function newTopic(){
        document.getElementById("topicname").value = "";
        document.getElementById("topicdesc").value = "";
        document.getElementById("topicname").disabled = false;
        document.getElementById("topicdesc").disabled = false;
        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");
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
