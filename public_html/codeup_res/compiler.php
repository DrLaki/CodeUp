<?php


/**
 * [Compiler class used to compile and run user code against our test cases]
 */
class Compiler{


    private $language;

    /**
     * [__construct constructs the Compiler object and is parametrized by the language user chose]
     * @param string $language
     */
    public function __construct($language) {
        $this->language = $language;
    }


    /**
     * [compile_and_run compiles and runs code that user provided. The code is ran against test cases]
     * @param  string $code             [user code]
     * @param  string $test_case_input  [input of the code which is provided by the user]
     * @param  string $test_case_output [expected output]
     * @param  float $max_exec_time    [maximum execution time of the user code]
     * @return array                   [return value is array containing information about error and user program output]
     */
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
