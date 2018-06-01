<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Privacy Policy",
    'css' => array('css/style.css', 'css/privacy.css'),
    'navigation' => $controller->header_navigation()
));

require_once("../codeup_res/views/privacy_policy.php");

render('footer');
?>
