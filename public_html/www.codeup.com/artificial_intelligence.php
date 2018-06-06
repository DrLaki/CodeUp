<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Artificial Intelligence",
    'css' => array('css/style.css', 'css/track.css'),
    'navigation' => $controller->header_navigation()
));

$controller->track('artificial_intelligence');

render('footer');
?>
