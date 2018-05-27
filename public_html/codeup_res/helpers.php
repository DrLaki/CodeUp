<?php

function render($file, $args = NULL) {
    $title = NULL;
    $css = NULL;
    $navigation = NULL;
    if($args != NULL) {
        $title = $args['title'];
        $css = $args['css'];
        $navigation = $args['navigation'];
    }

    $title = $args['title'];
    $css = $args['css'];
    $navigation = $args['navigation'];

    $PATH = "../codeup_res/views/include/" . $file . ".php";

    require_once($PATH);
}


function algorithm_subcategories() {
    return array('WarmUp', 'Strings', 'Sorting', 'Search', 'Graphs', 'Greedy', 'Dynamic Programming');
}

 ?>
