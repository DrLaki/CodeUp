<?php

define("RESULTS_PER_PAGE", 4);


class ProblemStatementsStorage {

    private static $tracks = array(
        'algorithms' => 'Algorithms',
        'data_structures' => 'Data Structures',
        'artificial_intelligence' => 'Artificial Intelligence'
    );
    private static $languages = array(
        'python' => 'Python',
        'java' => "Java",
        'c++' => 'C++'
    );

    public static function get_tracks() {
        return self::$tracks;
    }

    public static function get_languages() {
        return self::$languages;
    }

    private static $track_categories = array(
        'algorithms' => array('WarmUp' => 'WarmUp', 'Strings' =>'Strings', 'Sorting' =>'Sorting', 'Search' => 'Search', 'Graphs' => 'Graphs', 'Greedy' => 'Greedy', 'DynamicProgramming' => 'Dynamic Programming'),
        'data_structures' => array('WarmUp' => 'WarmUp', 'LinkedLists' => 'Linked Lists', 'Trees' => 'Trees'),
        'artificial_intelligence' => array('WarmUp' => 'WarmUp', 'Games' => 'Games', 'BotBuilding' => 'Bot Building')
    );

    public static function get_categories($track_name) {
        return self::$track_categories[$track_name];
    }


    private static $all_problems = array();


    private static $problems_in_categories = array(
        'algorithms' => array(
            'WarmUp' => array(array("0", "Hello World", "Easy", "10"), array("1", "Array Sum", "Easy", "10"), array("2", "Powers of two", "Easy", "10"), array("3", "Fibonnaci", "Medium", "20"), array("4", "Triplets", "Easy", "10")),
            'Strings' => array(),
            'Sorting' => array(),
            'Search' => array(),
            'Graphs' => array(),
            'Greedy' => array(),
            'DynamicProgramming' => array()
        ),
        'data_structures' => array(
            'WarmUp' => array(),
            'LinkedLists' => array(),
            'Trees' => array()
        ),
        'artificial_intelligence' => array(
            'WarmUp' => array(),
            'BotBuilding' => array(),
            'Games' => array()
        )
    );


    public static function get_problem_count($track_name, $category_name) {
        return (float)count(self::$problems_in_categories[$track_name][$category_name]);
    }

    public static function get_problems($track_name, $category_name, $page_num) {
        return array_slice(self::$problems_in_categories[$track_name][$category_name], ($page_num - 1) * RESULTS_PER_PAGE, RESULTS_PER_PAGE);
    }





}

?>
