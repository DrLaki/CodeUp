<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Change Password",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));

$controller->change_password();

render('footer');
?>
