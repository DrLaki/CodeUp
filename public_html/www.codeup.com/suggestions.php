<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");
require_once("../codeup_res/templates.php");

render('header', array(
    'title' => "Suggestions",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));

$controller->handle_suggestions();

render('footer');
?>
