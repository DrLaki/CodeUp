<?php

require_once("../codeup_res/helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Welcome to CodeUp",
    'css' => array('css/style.css', 'css/index.css'),
    'navigation' => $controller->header_navigation()
));

$controller->index();

render('footer');
?>
