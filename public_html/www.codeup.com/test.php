
<!--

 Dejane ignorisi ovo, koristim ovaj fajl kad hocu da testiram sta radi
neki funkcija PHPa


-->

<?php

define("DAYS", 10);
define("HOURS_IN_DAY", 24);
define("MINS_IN_HOUR", 60);

 ?>

 <?php

 require_once("../codeup_res/helpers.php");
 require_once("../codeup_res/choose_controller.php");

 render('header', array(
     'title' => "Privacy Policy",
     'css' => array('css/style.css', 'css/privacy.css'),
     'navigation' => $controller->header_navigation()
 ));
?>

<section id="main">
    <div class="login-form">

        <form action="index.html" method="post">
            <legend>Log-In Info</legend>
            <fieldset>
                <input name="username" type="username" required autocomplete="off" placeholder="Username"/>
                <input name="password" type="password" required autocomplete="off" placeholder="Password"/>
                <p class="forgot-password"><a href="#">Forgot Password?</a></p>
                <input type="submit" class="login-button" value="Log-in" />
            </fieldset>
        </form>
    </div>
</section>


<?php
 render('footer');
 ?>
