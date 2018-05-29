<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/problem_statement_helpers.php");

require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Solving Problem Statements",
    'css' => problem_statement_style_sheets(),
    'scripts' => problem_statement_scripts(),
    'navigation' => $controller->header_navigation()
));

render_problem_statement();

render('footer');
?>
