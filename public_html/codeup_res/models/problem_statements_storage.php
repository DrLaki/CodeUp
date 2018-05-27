<?php

define("RESULTS_PER_PAGE", 4);


class ProblemStatementsStorage {

    //first value is used as a file name and second value is used for displaying
    private static $tracks = array(
        'algorithms' => 'Algorithms',
        'data_structures' => 'Data Structures',
        'artificial_intelligence' => 'Artificial Intelligence'
    );
    //first value is used as a file name and second value is used for displaying
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





}

?>
