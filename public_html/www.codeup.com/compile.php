<?php

session_start();

/**
 * [all_fields_are_set checks if all parameters in the POST request are set]
 */
function all_fields_are_set() {
    return isset($_POST['type']) && isset($_POST['language']) && isset($_POST['code']) && isset($_POST['id']);
}

if(all_fields_are_set()){
    require_once("../codeup_res/models/problem_statements_storage.php");
    require_once("../codeup_res/models/account_manager.php");
    require_once("../codeup_res/compiler.php");

    if(!isset($_SESSION['user_type'])) {
        echo "You can solve problems after you login.";
        return;
    }

    $type = $_POST['type'];
    $language = $_POST['language'];
    $code = $_POST['code'];
    $problem_statement_id = $_POST['id'];
    $username = $_SESSION['username'];
    $compiler = new Compiler($language);
    if($type == 'submit') {
        $test_cases = ProblemStatementsStorage::get_test_cases($problem_statement_id);
        foreach ($test_cases as $test_case) {
            $result = $compiler->compile_and_run($code, $test_case['input'], $test_case['output'], $test_case['test_case_exec_time']);
            if($result['error_happened'] == TRUE) {
                if($result['output'] == "You have been timed out.") {
                    echo $result['output'];
                    return;
                }
                echo "You have error in your code.\n";
                echo "Your output: " . $result['output'];
                return;
            }
        }
        echo "Congratulations! You successfully solved the problem!";
        if(ProblemStatementsStorage::mark_as_solved($username, $problem_statement_id)) {
            $points = ProblemStatementsStorage::get_points($problem_statement_id);
            $category_id = ProblemStatementsStorage::get_category_id_by_problem_statement_id($problem_statement_id);
            $track_id = ProblemStatementsStorage::get_track_id_by_category_id($category_id);
            $track = ProblemStatementsStorage::get_track_by_id($track_id);
            $track_name = $track['track_name'];

            AccountManager::add_points_to_user($username, $points);
            ProblemStatementsStorage::add_points_to_users_track_points($username, $track_name, $points);
        }
    }
    else {
        $sample_test_case = ProblemStatementsStorage::get_sample_test_case($problem_statement_id);
        $result = $compiler->compile_and_run($code, $sample_test_case['sample_input'], $sample_test_case['sample_output'], $sample_test_case['sample_case_exec_time']);
        if($result['error_happened'] == TRUE) {
            if($result['output'] == "You have been timed out.") {
                echo "You have been timed out.";
                return;
            }
            echo "Expected output: " . $sample_test_case['sample_output'] . "\n";
            echo "Your output: " . $result['output'];
        }
        else{
            echo "Congratulations! Your code works well with the sample test case!";
        }
    }
}
else{
    echo "Error happened";
}

 ?>
