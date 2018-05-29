<?php

function track_style_sheets() {
    return array('css/style.css', 'css/track.css');
}

function render_categories($track, $categories) {
    foreach ($categories as $category => $category_name_to_display) {
        if($category == $_GET['category']) {
            echo '<li class="category curr-category"> <a href="' . $track . '?category=' . $category . '">' . $category_name_to_display .'</a> </li>';
        }
        else {
            echo '<li class="category"> <a href="' . $track . '?category=' . $category . '">' . $category_name_to_display .'</a> </li>';
        }
    }
}

function render_problem_statements($track_name, $category_name) {
    $problem_statements = ProblemStatementsStorage::problem_statements($track_name, $category_name, (int)$_GET['page']);
    foreach ($problem_statements as $problem_statement) {
        $problem_id = $problem_statement[0];
        $problem_name = $problem_statement[1];
        $problem_difficulty = $problem_statement[2];
        $problem_max_score = $problem_statement[3];
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


function render_navigation($track_name, $category_name) {
    $problem_statements_count = ProblemStatementsStorage::count_problem_statements_in_category($track_name, $category_name);
    if($problem_statements_count == 0)
        return;
    $first_page = 1;
    $last_page = ceil((float)$problem_statements_count / (float)RESULTS_PER_PAGE);

    //if on the first page show only next and last
    if((int)$_GET['page'] == 1) {
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

function error_happened($track_name){
    if(!isset($_GET['category'])) {
        return TRUE;
    }
    else if(!array_key_exists($_GET['category'], ProblemStatementsStorage::categories($track_name))){
        return TRUE;
    }
    else {
        return FALSE;
    }
}

function render_track($track_name) {
    require_once("../codeup_res/models/problem_statements_storage.php");

    if(error_happened($track_name)){
        require_once("../codeup_res/error404.php");
        return;
    }

    if(!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }

    $track_categories = ProblemStatementsStorage::categories($track_name);
    $category_name = $_GET['category'];
    require_once("../codeup_res/views/track.php");

}

 ?>
