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
    else if(!array_key_exists($_GET['id'], ProblemStatementsStorage::all_problems())) {
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

    $problem_statement = ProblemStatementsStorage::problem_statement($_GET['id']);

    $problem_id = $_GET['id'];
    $problem_name = $problem_statement['name'];
    $problem_difficulty = $problem_statement['difficulty'];
    $problem_max_score = $problem_statement['max_score'];
    $problem_description = $problem_statement['description'];
    $problem_sample_input = $problem_statement['sample_input'];
    $problem_sample_output = $problem_statement['sample_output'];
    $problem_explanation = $problem_statement['explanation'];
    $track_name = $problem_statement['track'];
    $category_name = $problem_statement['category'];


    require_once("../codeup_res/views/problem_statement.php");

}


 ?>
