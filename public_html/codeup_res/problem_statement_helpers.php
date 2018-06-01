<?php

function problem_statement_style_sheets() {
    return array('css/style.css', 'css/problem_statement.css', 'codemirror/lib/codemirror.css', 'codemirror/theme/neo.css');
}

function problem_statement_scripts() {
    return array('../codeup_res/views/codemirror/lib/codemirror.js', '../codeup_res/views/codemirror/mode/javascript/javascript.js', '../codeup_res/views/codemirror/mode/css/css.js', '../codeup_res/views/codemirror/mode/javascript/css.js', '../codeup_res/views/problem_statement.js');
}



function error_happened(){
    if(!isset($_GET['id'])){
        return TRUE;
    }
    else if(!ProblemStatementsStorage::problem_statement_exist($_GET['id'])) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

function render_problem_statement(){
    require_once("../codeup_res/models/problem_statements_storage.php");

    if(error_happened()) {
        require_once("../codeup_res/error404.php");
        return;
    }

    $problem_statement = ProblemStatementsStorage::get_problem_statement($_GET['id']);

    $problem_id = $_GET['id'];
    $problem_name = $problem_statement['problem_statement_name'];
    $problem_difficulty = $problem_statement['difficulty'];
    $problem_max_score = $problem_statement['points'];
    $problem_description = $problem_statement['problem_statement_description'];
    $problem_sample_input = $problem_statement['sample_input'];
    $problem_sample_output = $problem_statement['sample_output'];
    $category_id = $problem_statement['category_id'];

    $category = ProblemStatementsStorage::get_category($category_id);
    $category_name = $category['category_name'];
    $category_url = $category['category_url'];
    $track_id = $category['track_id'];
    $track = ProblemStatementsStorage::get_track_by_id($track_id);
    $track_name = $track['track_name'];
    $track_url = $track['track_url'];

    require_once("../codeup_res/views/problem_statement.php");

}


 ?>
