<?php

class Compiler{

    private $language;

    public function __construct($language) {
        $this->language = $language;
    }

    public function compile_and_run($code, $test_case_input, $test_case_output, $max_exec_time){
        if($this->language == "python") {
            $python_file = "../codeup_res/user_code/user_code.py";
            //write code to the file which will be ran later
            file_put_contents("$python_file", $code);

            //run code
            $output = array();
            exec("../codeup_res/user_code/python.sh ./$python_file '$test_case_input' $max_exec_time", $output);
            unlink($python_file);//delete python file
            $output = implode("\n", $output);
            if($output == $test_case_output) {
                return array('error_happened' => FALSE);
            }
            else {
                return array('error_happened' => TRUE, 'output' => $output);
            }
        }
    }
}


 ?>
