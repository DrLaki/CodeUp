
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



<?php
 render('footer');
 ?>
