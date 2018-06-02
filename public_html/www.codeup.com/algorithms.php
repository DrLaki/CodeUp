<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Algorithms",
    'css' => $controller->track_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->track('algorithms');

render('footer');
?>
