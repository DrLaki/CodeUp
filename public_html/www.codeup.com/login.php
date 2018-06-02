<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Login",
    'css' => $controller->login_style_sheets(),
    'navigation' => $controller->header_navigation()
));

if(!isset($_SESSION['user_type']))
    $controller->login();
else {
    require_once("../codeup_res/error404.php");
}

render('footer');
?>
