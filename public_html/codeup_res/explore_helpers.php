<?php

function explore_style_sheets() {
    return array('css/style.css', 'css/explore.css');
}

function render_tracks() {
    $tracks = ProblemStatementsStorage::get_tracks();
    foreach ($tracks as $track_url => $track_name) {
        echo '<div class="category">
                  <a href="' . $track_url . '?category=warm_up">
                    <img src="../codeup_res/views/img/' . $track_url . '.png" alt="' . $track_name . ' icon">
                  </a>

                  <h5>' . $track_name . '</h5>
              </div>';
    }
}

function render_languages() {
    $languages = ProblemStatementsStorage::languages();
    foreach ($languages as $language => $language_name_to_display) {
        echo '<div class="category">
                  <a href="' . $language . '?category=warm_up">
                    <img src="../codeup_res/views/img/' . $language . '.png" alt="' . $language_name_to_display . ' icon">
                  </a>

                  <h5>' . $language_name_to_display . '</h5>
              </div>';
    }
}

function render_explore() {
    require_once("../codeup_res/models/problem_statements_storage.php");
    require_once("../codeup_res/views/explore.php");
}

?>
