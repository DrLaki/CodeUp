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
    if($type == 'submit') {
        $test_cases = ProblemStatementsStorage::test_cases($problem_statement_id);
        $test_outputs = ProblemStatementsStorage::test_case_outputs($problem_statement_id);
        for($i = 0; $i < count($test_cases); $i++) {
            $result = $compiler->compile_and_run($code, $test_cases[$i], $test_outputs[$i]);
            if($result['error_happened'] == TRUE) {
                echo "You have error in your code.\n";
                echo "Your output: " . $result['output'];
                return;
            }
        }
        echo "Congratulations! You successfully solved the problem!";
    }
    else {
        $sample_test_case = ProblemStatementsStorage::sample_test_case($problem_statement_id);
        $sample_output = ProblemStatementsStorage::sample_output($problem_statement_id);
        $result = $compiler->compile_and_run($code, $sample_test_case, $sample_output);
        if($result['error_happened'] == TRUE) {
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
