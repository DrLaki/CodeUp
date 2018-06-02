<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Artificial Intelligence",
    'css' => $controller->track_style_sheets(),
    'navigation' => $controller->header_navigation()
));

$controller->track('artificial_intelligence');

render('footer');
?>
