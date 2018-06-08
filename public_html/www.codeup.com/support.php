<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Support",
    'css' => array(
        'css/style.css',
        'css/support.css'
    ),
    'navigation' => $controller->header_navigation()
));

$controller->support();

render('footer');

 ?>
