<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Adding New Content",
    'css' => array('css/style.css', 'css/add_content.css'),
    'navigation' => $controller->header_navigation()
));

$controller->add_content();

render('footer');
?>
