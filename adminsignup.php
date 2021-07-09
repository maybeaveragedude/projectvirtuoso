<?php
  include_once 'header.php';
?>

    <main class="page hire-me-page">
        <section class="portfolio-block hire-me">
            <section class="register-photo">
                <div class="form-container">
                    <div class="align-self-center image-holder" style="max-height: 506px;"></div>
                    <!--Changed file path below-->
                    <form method="post" action="includes/adminsignup.inc.php">
                        <h2 class="text-center"><strong>Create</strong> an account.</h2>
                        <div style="margin-bottom: 16px;"><input class="form-control" type="text" placeholder="Full Name" name="name"></div>
                        <div style="margin-bottom: 16px;"><input class="form-control" type="text" placeholder="Username" name="username"></div>
                        <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                        <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                        <div class="mb-3"><input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)"></div>
                        <div class="mb-3" style="margin-bottom: 0px;"></div>
                        <?php
                        //this is error handling message for users
                          if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput"){
                              echo "<p>Fill in all fields!<p>";
                            }
                            elseif ($_GET["error"] == "invalidname") {
                              echo "<p>No special characters allowed in names!<p>";
                            }
                            elseif ($_GET["error"] == "invalidusername") {
                              echo "<p>Only alphanumerics characters allowed in username!<p>";
                            }
                            elseif ($_GET["error"] == "passwordsdontmatch") {
                              echo "<p>Repeated password does not match!<p>";
                            }
                            elseif ($_GET["error"] == "usernametaken") {
                              echo "<p>Username is taken!<p>";
                            }
                            elseif ($_GET["error"] == "stmtfailed") {
                              echo "<p>Something wrong occured! Please try again later.<p>";
                            }
                            elseif ($_GET["error"] == "none") {
                              echo "<p>Account created successfully!<p>";
                              //***This line redirects user to learner home page***
                              header("Refresh:2; url=learnerhome.php");
                            }
                          }
                        ?>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100" id="signup" type="submit" name="signup" style="margin-top: 0px;">Sign Up</button></div><a class="already" href="adminlogin.php">You already have an account? Login here.</a>
                    </form>
                </div>
            </section>
        </section>
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
    <script src="assets/js/theme.js"></script>
</body>

</html>
