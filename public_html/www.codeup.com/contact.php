<?php
require_once('../codeup_res/helpers.php');
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Contact",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));
?>

<section id="main">
        <p style="margin:0px auto; text-align:center; padding: 50px; font-size:2em;"> Nothing to show on this page. </p>
</section>


<?php
render('footer');
?>
