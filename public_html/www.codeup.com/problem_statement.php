<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Solving Problem Statements",
    'css' => array('css/style.css', 'css/problem_statement.css',
                'codemirror/lib/codemirror.css', 'codemirror/theme/neo.css'),
    'scripts' => array('../codeup_res/views/codemirror/lib/codemirror.js',
                        '../codeup_res/views/codemirror/mode/javascript/javascript.js',
                         '../codeup_res/views/codemirror/mode/css/css.js',
                         '../codeup_res/views/codemirror/mode/javascript/css.js',
                         '../codeup_res/views/problem_statement.js'),
    'navigation' => $controller->header_navigation()
));

$controller->problem_statement();

render('footer');
?>
