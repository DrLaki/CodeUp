<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Explore problem statements",
    'css' => $controller->explore_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->explore();

render('footer');
?>
