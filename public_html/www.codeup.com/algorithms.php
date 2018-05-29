<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/track_helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Algorithms",
    'css' => track_style_sheets(),
    'navigation' => $controller->header_navigation()
));

render_track('algorithms');

render('footer');
?>
