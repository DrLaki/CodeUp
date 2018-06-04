<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Account Confirmation",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));

$controller->account_confirmation();

render('footer');
?>
