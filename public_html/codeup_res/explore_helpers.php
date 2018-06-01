<?php

/**
 * [explore_style_sheets returns style sheets which are used by explore.php]
 * @return array
 */
function explore_style_sheets() {
    return array('css/style.css', 'css/explore.css');
}

/**
 * [render_tracks function is used for rendering tracks]
 * @return void
 */
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

/**
 * [render_languages function is used for rendering languages our users can learn on our platform]
 * @return void
 */
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

/**
 * [render_explore renders explore located in views folder]
 * @return void
 */
function render_explore() {
    require_once("../codeup_res/models/problem_statements_storage.php");
    require_once("../codeup_res/views/explore.php");
}

?>
