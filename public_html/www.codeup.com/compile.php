<?php

function all_fields_are_set() {
    return isset($_POST['type']) && isset($_POST['language']) && isset($_POST['code']) && isset($_POST['id']);
}

if(all_fields_are_set()){
    require_once("../codeup_res/models/problem_statements_storage.php");
    require_once("../codeup_res/compiler.php");
    $type = $_POST['type'];
    $language = $_POST['language'];
    $code = $_POST['code'];
    $problem_statement_id = $_POST['id'];
    $compiler = new Compiler($language);
    $max_exec_time = "0.1";
    if($type == 'submit') {
        $test_cases = ProblemStatementsStorage::get_test_cases($problem_statement_id);
        foreach ($test_cases as $test_case) {
            $result = $compiler->compile_and_run($code, $test_case['input'], $test_case['output'], $max_exec_time);
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
    }
    else {
        $sample_test_case = ProblemStatementsStorage::get_sample_test_case($problem_statement_id);
        $sample_input = $sample_test_case['sample_input'];
        $sample_output = $sample_test_case['sample_output'];
        $result = $compiler->compile_and_run($code, $sample_input, $sample_output, $max_exec_time);
        if($result['error_happened'] == TRUE) {
            if($result['output'] == "You have been timed out.") {
                echo "You have been timed out.";
                return;
            }
            echo "Expected output: " . $sample_output . "\n";
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
