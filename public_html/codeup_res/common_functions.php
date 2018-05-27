<?php
//explore helper functions
function explore_style_sheets() {
    return array('style.css', 'explore.css');
}

function display_all_tracks() {
    $tracks = ProblemStatementsStorage::get_tracks();
    foreach ($tracks as $track => $value_to_display) {
        echo '<div class="category">
                  <a href="' . $track . '?category=WarmUp">
                    <img src="../codeup_res/views/img/' . $track . '.png" alt="' . $value_to_display . ' icon">
                  </a>

                  <h5>' . $value_to_display . '</h5>
              </div>';
    }
}

function display_all_languages() {
    $languages = ProblemStatementsStorage::get_languages();
    foreach ($languages as $language => $value_to_display) {
        echo '<div class="category">
                  <a href="' . $language . '?category=WarmUp">
                    <img src="../codeup_res/views/img/' . $language . '.png" alt="' . $value_to_display . ' icon">
                  </a>

                  <h5>' . $value_to_display . '</h5>
              </div>';
    }
}

function display_explore() {
    require_once("../codeup_res/models/problem_statements_storage.php");

    require_once("../codeup_res/views/explore.php");
}

//domain helper functions
function track_style_sheets() {
    return array('style.css', 'track.css');
}

function path_to_problem($file_name, $category_name) {
    echo '<a href="explore" class="page">Explore</a> > ';
    echo '<a href="' . $file_name . '?category=WarmUp" class="page">' . ucfirst($file_name) . '</a> > ';
    echo '<a href="' . $file_name . '?category=' . $category_name . '" class="page">' . ProblemStatementsStorage::get_categories($file_name)[$_GET['category']] . '</a>';
}

function display_categories($file_name, $categories) {
    foreach ($categories as $key => $value) {
        if($key == $_GET['category']) {
            echo '<li class="category curr-category"> <a href="' . $file_name . '?category=' . $key . '">' . $value .'</a> </li>';
        }
        else {
            echo '<li class="category"> <a href="' . $file_name . '?category=' . $key . '">' . $value .'</a> </li>';
        }
    }
}

function display_problems($track_name, $category_name) {
    $problems = ProblemStatementsStorage::get_problems($track_name, $category_name, (int)$_GET['page']);
    foreach ($problems as $problem) {
        echo '<li>
                <div class="problem-statement">
                  <h4 class="problem-name">' . $problem[1] . '</h4>
                  <span class="stats">
                    <span class="' . $problem[2] . '">Difficulty:
                      <span class="value">Easy</span>
                    </span>
                    <span class="' . $problem[3] . '">Max Score:
                      <span class="value">10</span>
                    </span>
                  </span>
                  <a href="problem_statement?id=' . $problem[0] . '" class="submit-button">
                    <button type="submit">Solve</button>
                  </a>
                </div>
              </li>';
    }
}


function display_navigation($file_name, $category_name) {
    $count = ProblemStatementsStorage::get_problem_count($file_name, $category_name);
    if($count == 0)
        return;
    $last_page = ceil((float)$count / (float)RESULTS_PER_PAGE);

    if((int)$_GET['page'] == 1) {
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] + 1) . '" class="page">next</a></i>';
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . $last_page . '" class="page">last</a></i>';
    }
    else if((int)$_GET['page'] == (int)$last_page) {
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=1" class="page">first</a></i>';
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . ($last_page - 1) . '" class="page">previous</a></i>';
    }
    else {
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=1" class="page">first</a></i>';
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] + 1) . '" class="page">next</a></i>';
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . ((int)$_GET['page'] - 1) . '" class="page">previous</a></i>';
        echo '<i class="material-icons"><a href="' . $file_name . '?category=' . $category_name . '&page=' . $last_page . '" class="page">last</a></i>';
    }
}

function display_track($file_name) {
    require_once("../codeup_res/models/problem_statements_storage.php");

    if(!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }

    if(!isset($_GET['category'])) {
        require_once("../codeup_res/error404.php");
        return;
    }
    else if(!array_key_exists($_GET['category'], ProblemStatementsStorage::get_categories($file_name))){
        require_once("../codeup_res/error404.php");
        return;
    }
    else {
        $category_name = $_GET['category'];
        $categories = ProblemStatementsStorage::get_categories($file_name);
        require_once("../codeup_res/views/track.php");
    }
}

?>
