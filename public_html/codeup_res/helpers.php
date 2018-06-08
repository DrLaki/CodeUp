<?php

/**
 * [render is used to render the header and the footer of all pages]
 * @param  string $file [name of the file to render]
 * @param  array $args [associative array with title, navigation, scripts and style sheets keys and
 *  their corresponding values: for title that is string; for all other keys that is array]
 * @return void
 */
function render($file, $args = NULL) {

    if($args != NULL)
        extract($args);

    $PATH = "../codeup_res/views/include/" . $file . ".php";

    require_once($PATH);
}

/**
 * [path_to_problem function displays path to the problem or category user has chosen]
 * @param  string $track_url     [file that is requested by the server if user clicks on the track name]
 * @param  string $track_name    [name of the track to be displayed to the user]
 * @param  string $category_url  [url of the category that is used as category parameter in GET request]
 * @param  string $category_name [name of the category to be displayed to the user]
 * @param  string $problem_name  [name of the problem to be displayed to the user]
 * @param  int    $problem_id    [description]
 * @return void
 */
function path_to_problem($track_url, $track_name, $category_url, $category_name, $problem_name = NULL, $problem_id = NULL) {
    echo '<a href="explore" class="page">Explore</a> > ';
    echo '<a href="' . $track_url . '?category=warmup" class="page">' . $track_name . '</a> > ';
    echo '<a href="' . $track_url . '?category=' . $category_url . '" class="page">' . $category_name . '</a>';
    if($problem_name != NULL) {
        echo ' > <a href="problem_statement.php?id=' . $problem_id . '" class="page">' . $problem_name . '</a>';
    }
}

 ?>
