<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Support",
    'css' => array(
        'css/style.css'
    ),
    'navigation' => $controller->header_navigation()
));

if(isset($_SESSION['user_type']))
    $controller->serach_users();
else
    require_once("..codeup_res/error404.php");

render('footer');

 ?>
