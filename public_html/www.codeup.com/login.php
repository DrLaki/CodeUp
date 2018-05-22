<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Login",
    'css' => $controller->login_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->login();

render('footer');
?>
