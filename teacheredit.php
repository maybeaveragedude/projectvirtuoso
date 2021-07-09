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
                                          foreach ($_SESSION["teachersubjectsCombined"][0] as $display) {
                                            $tempname = $display['sbjt_name'];
                                            $tempdesc = $display['sbjt_desc'];
                                            echo "<input type='button' class='dropdown-item' id='subject$num' onclick=\"setDisplay('$tempname', '$tempdesc')\" value = '$tempname'>";
                                            // echo '<pre>'; print_r($result); echo '</pre>';
                                            // echo '<pre>'; print_r($display); echo '</pre>';
                                            $num += 1;


                                          }
                                          echo "<input type='button' class='dropdown-item' id='subject$num' onclick=\"newSubj()\" value = ' ➕ New Subject'>";

                                           ?>
                                          <!-- <a class="dropdown-item" href="#">First Item</a>
                                          <a class="dropdown-item" href="#">Second Item</a>
                                          <a class="dropdown-item" href="#">Third Item</a> -->
                                        </div>
                                        <script>
                                          function setDisplay(displaySubject, displayDesc){
                                            console.log(displaySubject);
                                            document.getElementById("subjectname").value = displaySubject;
                                            document.getElementById("subjectdesc").value = displayDesc;
                                            document.getElementById("subjectname").readOnly = true;
                                            document.getElementById("subjectdesc").readOnly = true;
                                            var element = document.getElementById("dropmenuSubj");
                                            element.setAttribute('aria-expanded', 'false');
                                            element.classList.toggle("show");
                                            var element2 = document.getElementById("dropmenuboxSubj");
                                            element2.classList.toggle("show");

                                          }
                                          function newSubj(){
                                            document.getElementById("subjectname").value = "";
                                            document.getElementById("subjectdesc").value = "";
                                            document.getElementById("subjectname").readOnly = false;
                                            document.getElementById("subjectdesc").readOnly = false;
                                            var element = document.getElementById("dropmenuSubj");
                                            element.setAttribute('aria-expanded', 'false');
                                            element.classList.toggle("show");
                                            var element2 = document.getElementById("dropmenuboxSubj");
                                            element2.classList.toggle("show");
                                          }

                                        </script>
                                    </div>
                                    <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" readonly="">
                                    <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" readonly=""></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="padding: 0px;border-top-width: 0.5px;border-bottom-width: 1px;border-bottom-style: solid;">
                                    <div class="dropdown" style="border-top-width: 0px;"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" aria-expanded="false" data-bs-toggle="dropdown" type="button">Topics</button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#">First Item</a>
                                          <a class="dropdown-item" href="#">Second Item</a>
                                          <a class="dropdown-item" href="#">Third Item</a></div>
                                    </div><input class="form-control sidetitles" type="text" readonly="" name="topicname" placeholder="Topic Title"><textarea class="form-control sidetitles" readonly="" name="topicdesc" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="height: 900px;padding: 0px 40px;border-left-width: 1px;border-left-style: solid;margin: 14px 0px;"><label class="form-label middlelabel biggerlabel">Subtopic Title</label><input class="form-control" type="text"><label class="form-label middlelabel biggerlabel">Description</label><textarea class="form-control" style="height: 200px;"></textarea></div>
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