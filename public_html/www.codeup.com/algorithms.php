<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/common_functions.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Algorithms",
    'css' => track_style_sheets(),
    'navigation' => $controller->header_navigation()
));

display_track('algorithms');

render('footer');
?>
