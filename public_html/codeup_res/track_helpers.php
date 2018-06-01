<?php

/**
 * [track_style_sheets function returns style sheets used by the track.php file]
 * @return array
 */
function track_style_sheets() {
    return array('css/style.css', 'css/track.css');
}

/**
 * [render_categories function renders categories of the chosen track]
 * @param  string $track_url  [url of the chosen track]
 * @param  array $categories [categories which belong to that track]
 * @return boolean
 */
function render_categories($track_url, $categories) {
    foreach ($categories as $category_url => $category_name) {
        if($category_url == $_GET['category']) {
            echo '<li class="category curr-category"> <a href="' . $track_url . '?category=' . $category_url . '">' . $category_name .'</a> </li>';
        }
        else {
            echo '<li class="category"> <a href="' . $track_url . '?category=' . $category_url . '">' . $category_name .'</a> </li>';
        }
    }
}

/**
 * [render_problem_statements renders part of the page which contains the list of problem_statements]
 * @param  int $category_id [category id is used to find all problem statements that belong to that category]
 * @return void
 */
function render_problem_statements($category_id) {
    $problem_statements = ProblemStatementsStorage::get_problem_statements($category_id, (int)$_GET['page']);
    foreach ($problem_statements as $problem_statement) {
        $problem_id = $problem_statement['problem_statement_id'];
        $problem_name = $problem_statement['problem_statement_name'];
        $problem_difficulty = $problem_statement['difficulty'];
        $problem_max_score = $problem_statement['points'];
        echo '<li>
                <div class="problem-statement">
                  <h4 class="problem-name">' . $problem_name . '</h4>
                  <span class="stats">
                    <span class="Difficulty">Difficulty:
                      <span class="value">' . $problem_difficulty . '</span>
                    </span>
                    <span class="Max Score">Max Score:
                      <span class="value">' . $problem_max_score . '</span>
                    </span>
                  </span>
                  <a href="problem_statement?id=' . $problem_id . '" class="submit-button">
                    <button type="submit">Solve</button>
                  </a>
                </div>
              </li>';
    }
}

/**
 * [render_navigation function is used to render navigation for problem_statements]
 * @param  int $category_id [this function uses category id to get the number of all problems in given category]
 * @return void
 */
function render_navigation($category_id) {
    $problem_statements_count = ProblemStatementsStorage::count_problem_statements_in_category($category_id);
    $first_page = 1;
    $last_page = ceil((float)$problem_statements_count / (float)RESULTS_PER_PAGE);
    if($first_page >= $last_page)//last page has value 0 if there are 0 problem statements in that category
        return;
    //user delibaretly modifies page parameter of the GET request
    else if((int)$_GET['page'] > $last_page) {
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $first_page . '" class="page">first</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $last_page . '" class="page">last</a></i>';
    }
    //if on the first page show only next and last
    else if((int)$_GET['page'] == 1) {
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] + 1) . '" class="page">next</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $last_page . '" class="page">last</a></i>';
    }
    //if on the last page show only first and previous
    else if((int)$_GET['page'] == (int)$last_page) {
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $first_page . '" class="page">first</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . ($last_page - 1) . '" class="page">previous</a></i>';
    }
    //show whole navigation panel
    else {
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $first_page . '" class="page">first</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] + 1) . '" class="page">next</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] - 1) . '" class="page">previous</a></i>';
        echo '<i class="material-icons"><a href="' . $track_name . '?category=' . $category_name . '&page=' . $last_page . '" class="page">last</a></i>';
    }
}

/**
 * [error_happened checks if category parameter of the GET request exists]
 * @param  array $track_categories [associative array with category_url key category_name value]
 * @return boolean                 [if error happened, returns TRUE, FALSE otherwise]
 */
function error_happened($track_categories){
    if(!isset($_GET['category'])) {
        return TRUE;
    }
    else if(!array_key_exists($_GET['category'], $track_categories)){
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * [render_track renders the track.php file located in views folder]
 * @param  string $track_url [url of the chosen track]
 * @return void
 */
function render_track($track_url) {
    require_once("../codeup_res/models/problem_statements_storage.php");

    $track = ProblemStatementsStorage::get_track_by_url($track_url);
    $track_id = $track['track_id'];
    $track_name = $track['track_name'];

    //category_url => category_name
    $track_categories = ProblemStatementsStorage::get_track_categories($track_id);

    if(error_happened($track_categories)){
        print_r($track_categories);
        echo $_GET['category'];
        require_once("../codeup_res/error404.php");
        return;
    }

    if(!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }

    $category_url = $_GET['category'];
    $category_id = ProblemStatementsStorage::get_category_id($track_id, $category_url);

    require_once("../codeup_res/views/track.php");

}

 ?>
