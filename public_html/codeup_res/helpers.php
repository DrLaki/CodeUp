<?php

function render($file, $args = NULL) {

    if($args != NULL)
        extract($args);

    $PATH = "../codeup_res/views/include/" . $file . ".php";

    require_once($PATH);
}


function path_to_problem($track_url, $track_name, $category_url, $category_name, $problem_name = NULL, $problem_id = NULL) {
    echo '<a href="explore" class="page">Explore</a> > ';
    echo '<a href="' . $track_url . '?category=warm_up" class="page">' . $track_name . '</a> > ';
    echo '<a href="' . $track_url . '?category=' . $category_url . '" class="page">' . $category_name . '</a>';
    if($problem_name != NULL) {
        echo ' > <a href="problem_statement.php?id=' . $problem_id . '" class="page">' . $problem_name . '</a>';
    }
}

 ?>
