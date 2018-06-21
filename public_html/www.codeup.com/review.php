<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "User suggestions",
    'css' => array('css/style.css', 'css/login.css'),
    'navigation' => $controller->header_navigation()
));
$controller->show_bug_reports();
render('footer');
?>
