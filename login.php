<?php
  include_once 'header.php';
  loggedInInvalidUserAcess();
?>

    <main class="page login page">
        <!-- <section class="portfolio-block block-intro border-bottom"> -->
            <section class="login-dark">
                <form method="post" action="includes/login.inc.php"  style="margin-top: -96px;">
                    <h2 class="visually-hidden">Login Form</h2>
                    <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                    <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                    <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                    <?php
                    //this is error handling message for users
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                          echo "<p>Fill in empty fields!<p>";
                        }
                        elseif ($_GET["error"] == "wronglogin"){
                          echo "<p>Incorrect login credentials.<p>";
                        }
                      }
                    ?>
                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a>
                </form>
            </section>
        <!-- </section> -->
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
