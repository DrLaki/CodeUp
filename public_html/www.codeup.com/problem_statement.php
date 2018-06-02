<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Solving Problem Statements",
    'css' => $controller->problem_statement_style_sheets(),
    'scripts' => $controller->problem_statement_scripts(),
    'navigation' => $controller->header_navigation()
));

$controller->problem_statement();

render('footer');
?>
