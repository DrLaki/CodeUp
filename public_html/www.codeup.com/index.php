<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Welcome to CodeUp",
    'css' => $controller->index_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->index();

render('footer');
?>
