<?php

class Compiler{

    private $language;

    public function __construct($language) {
        $this->language = $language;
    }

    public function compile_and_run($code, $test_case_input, $expected_output){
        if($this->language == "python") {
            //write code to the file which will be ran later
            file_put_contents("../codeup_res/user_code/user_code.py", $code);

            //run code
            $output = array();
            exec("python ../codeup_res/user_code/user_code.py $test_case_input 2>&1", $output);
            $output = implode("\n", $output);
            if($output == $expected_output) {
                return array('error_happened' => FALSE);
            }
            else {
                return array('error_happened' => TRUE, 'output' => $output);
            }
        }




    }



}


 ?>
