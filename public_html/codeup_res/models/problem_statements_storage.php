<?php

define("RESULTS_PER_PAGE", 5);


class ProblemStatementsStorage {

    //key is used as a file name and value is used for displaying
    private static $tracks = array(
        'algorithms' => 'Algorithms',
        'data_structures' => 'Data Structures',
        'artificial_intelligence' => 'Artificial Intelligence'
    );
    //key is used as a file name and value is used for displaying
    private static $languages = array(
        'python' => 'Python',
        'java' => "Java",
        'c++' => 'C++'
    );


    private static $track_categories = array(
        'algorithms' => array('warm_up' => 'WarmUp', 'strings' =>'Strings', 'sorting' =>'Sorting', 'search' => 'Search', 'graphs' => 'Graphs', 'greedy' => 'Greedy', 'dynamic_programming' => 'Dynamic Programming'),
        'data_structures' => array('warm_up' => 'WarmUp', 'linked_lists' => 'Linked Lists', 'trees' => 'Trees'),
        'artificial_intelligence' => array('warm_up' => 'WarmUp', 'games' => 'Games', 'bot_building' => 'Bot Building')
    );

    //the most inner array: first field is problem_id, second is problem_name, third is $problem_difficulty and fourth is problem_max_score
    private static $category_problem_statements = array(
        'algorithms' => array(
            'warm_up' => array(array("0", "Hello World", "Easy", "10"), array("1", "Array Sum", "Easy", "10"), array("2", "Powers of two", "Easy", "10"), array("3", "Fibonnaci", "Medium", "20"), array("4", "Triplets", "Easy", "10")),
            'strings' => array(),
            'sorting' => array(),
            'search' => array(),
            'graphs' => array(),
            'greedy' => array(),
            'dynamic_programming' => array()
        ),
        'data_structures' => array(
            'warm_up' => array(),
            'linked_lists' => array(),
            'trees' => array()
        ),
        'artificial_intelligence' => array(
            'warm_up' => array(),
            'bot_building' => array(),
            'games' => array()
        )
    );

    //key is problem_statement_id
    private static $all_problems = array(
        '0' => array(
            'name' => 'Hello World',
            'difficulty' => 'Easy',
            'max_score' => '10',
            'track' => 'algorithms',
            'category' => 'warm_up',
            'description' => 'Print out "Hello, World!" to the standard output.',
            'sample_input' => 'No input',
            'sample_output' => 'Hello, World!',
            'explanation' => 'None.'
        ),
        '1' => array(
            'name' => 'Array Sum',
            'difficulty' => 'Easy',
            'max_score' => '10',
            'track' => 'algorithms',
            'category' => 'warm_up',
            'description' => '',
            'sample_input' => '',
            'sample_output' => '',
            'explanation' => ''
        ),
        '2' => array(
            'name' => 'Powers of Two',
            'difficulty' => 'Easy',
            'max_score' => '10',
            'track' => 'algorithms',
            'category' => 'warm_up',
            'description' => '',
            'sample_input' => '',
            'sample_output' => '',
            'explanation' => ''
        ),
        '3' => array(
            'name' => 'Fibonnaci',
            'difficulty' => 'Medium',
            'max_score' => '20',
            'track' => 'algorithms',
            'category' => 'warm_up',
            'description' => '',
            'sample_input' => '',
            'sample_output' => '',
            'explanation' => ''
        ),
        '4' => array(
            'name' => 'Triplets',
            'difficulty' => 'Easy',
            'max_score' => '10',
            'track' => 'algorithms',
            'category' => 'warm_up',
            'description' => '',
            'sample_input' => '',
            'sample_output' => '',
            'explanation' => ''
        )
    );


    private static $sample_test_cases = array(
        '0' => ''
    );

    private static $sample_outputs = array(
        '0' => 'Hello, World!'
    );

    private static $test_cases = array(
        '0' => array('')
    );

    private static $test_case_outputs = array(
        '0' => array('Hello, World!')
    );

    public static function tracks() {
        return self::$tracks;
    }

    public static function languages() {
        return self::$languages;
    }


    public static function categories($track_name) {
        return self::$track_categories[$track_name];
    }


    public static function count_problem_statements_in_category($track_name, $category_name) {
        return count(self::$category_problem_statements[$track_name][$category_name]);
    }

    public static function problem_statements($track_name, $category_name, $page_num) {
        return array_slice(self::$category_problem_statements[$track_name][$category_name], ($page_num - 1) * RESULTS_PER_PAGE, RESULTS_PER_PAGE);
    }


    public static function all_problems(){
        return self::$all_problems;
    }

    public static function problem_statement($problem_id){
        return self::$all_problems[$problem_id];
    }

    public static function test_cases($problem_id) {
        return self::$test_cases[$problem_id];
    }

    public static function test_case_outputs($problem_id) {
        return self::$test_case_outputs[$problem_id];
    }

    public static function sample_test_case($problem_id) {
        return self::$sample_test_cases[$problem_id];
    }

    public static function sample_output($problem_id) {
        return self::$sample_outputs[$problem_id];
    }

}

?>
