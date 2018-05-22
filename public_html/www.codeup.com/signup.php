<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Register",
    'css' => $controller->register_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->register();

render('footer');
?>
