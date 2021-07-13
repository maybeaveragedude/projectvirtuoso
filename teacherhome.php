<?php
  include_once 'teacherheader.php';
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
                               }

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
                                                <div>
                                                  <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1" role="button">Show Content</a>
                                                    <div class="collapse show" id="collapse-1">
                                                        <p>Collapse content.</p>
                                                        <!-- <form method="post" action="includes/teacheredit.inc.php">
                                                          <button class="btn btn-primary" type="submit" name="submit" style="border-radius: 7px;background: #1eb53a;">Edit</button>

                                                        </form> -->
                                                        <div><a class="btn btn-primary" style="border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something now!</a></div>
                                                    </div>
                                                </div>
                                                <div>
                                                  <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-2" href="#collapse-2" role="button">Show Content</a>
                                                    <div class="collapse" id="collapse-2">
                                                        <p>Collapse content.</p>
                                                    </div>
                                                </div>
                                                <div>
                                                  <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-3" href="#collapse-3" role="button">Show Content</a>
                                                    <div class="collapse" id="collapse-3">
                                                        <p>Collapse content.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">My Materials</button></h2>
                                        <div class="accordion-collapse collapse item-2 text-start" role="tabpanel" data-bs-parent="#accordion-1">
                                            <div class="accordion-body">
                                              <?php
                                              $num=0;
                                              // $testingarray =$_SESSION["teachersubjectsCombined"];
                                              // foreach ($testingarray as $value){
                                              //   echo '<pre>'; print_r($value); echo '</pre>';
                                              // }

                                              if (empty($_SESSION["teachersubjectsCombined"])){
                                                // echo "<script>alert('Poop');</script>";
                                                echo <<<GFG
                                                    <div>
                                                      <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1" role="button">It's pretty barren in here...</a>
                                                        <div class="collapse show" id="collapse-1">
                                                        </div>
                                                    </div>
                                                    <div><a class="btn btn-primary" style="border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something now!</a></div>
                                                GFG;



                                              }else {
                                                // echo "<script>alert('Great Success');</script>";
                                                // echo "<script>console.log(sizeof({$_SESSION["teachersubjectsCombined"]}));</script>";
                                                if (empty(empty($_SESSION["teachersubjectsCombined"]))){
                                                  echo <<<GFG
                                                      <div>
                                                        <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1" role="button">It's pretty barren in here...</a>
                                                          <div class="collapse show" id="collapse-1">
                                                          </div>
                                                      </div>
                                                      <div><a class="btn btn-primary" style="border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something now!</a></div>
                                                  GFG;
                                                }


                                                foreach ($_SESSION["teachersubjectsCombined"][0] as $display) {
                                                  $tempname = $display['sbjt_name'];
                                                  $tempdesc = $display['sbjt_desc'];
                                                  echo <<<GFG
                                                      <div>
                                                        <a class="btn btn-primary listgroupdropMain" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-{$num}" href="#collapse-{$num}" role="button">{$tempname}</a>
                                                          <div class="collapse show" id="collapse-{$num}">
                                                              <p>Collapse content.</p>

                                                          </div>
                                                      </div>
                                                  GFG;



                                                  // echo '<pre>'; print_r($result); echo '</pre>';
                                                  // echo '<pre>'; print_r($display); echo '</pre>';
                                                  $num += 1;
                                                }

                                              }
                                               ?>
                                               <!-- <div><a class="btn btn-primary" style="border-radius: 7px;background: #1eb53a;" href="includes/teacheredit.inc.php">Cultivate something now!</a></div> -->
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
<!-- <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient" style="color: rgb(255, 255, 255);background: rgb(255,255,255);">
    <div class="container"><a class="navbar-brand logo" href="index.html" style="color: var(bs-dark);font-family: Alatsi, sans-serif;"><img src="assets/img/Artboard%202@8x.png" style="width: 64px;padding: 0px;margin: -10px;">VIRTUOSO Teach</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="text-dark visually-hidden" style="color: rgb(0,0,0);">Toggle navigation</span><span class="navbar-toggler-icon text-dark" style="color: rgb(0,0,0);background: rgba(255,255,255,0);border-color: rgba(255,255,255,0);"><i class="fa fa-bars" style="color: rgb(0,0,0);text-align: center;margin: 4px;"></i></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="login.html" style="color: var(--bs-dark);">Support</a></li>
                <li class="nav-item"><a class="nav-link" href="signup.html" style="color: var(bs-dark);">My Account</a></li>
            </ul>
        </div>
    </div>
</nav> -->

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
