<?php

define("RESULTS_PER_PAGE", 5);

require_once("../codeup_res/database.php");

class ProblemStatementsStorage {

    //key is used as a file name and value is used for displaying
    private static $languages = array(
        'python' => 'Python',
        'java' => "Java",
        'c++' => 'C++'
    );

    public static function languages() {
        return self::$languages;
    }

    public static function get_tracks() {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_url, track_name FROM tracks";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        $tracks = array();

        foreach ($results as $result) {
            $tracks[$result['track_url']] = $result['track_name'];
        }
        return $tracks;
    }

    public function get_track_by_id($track_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_url, track_name FROM tracks WHERE track_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $track_id]);
        $result = $statement->fetch();
        return $result;
    }

    public function get_track_by_url($track_url) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_id, track_name FROM tracks WHERE track_url=:track_url";
        $statement = $connection->prepare($sql);
        $statement->execute(['track_url' => $track_url]);
        $result = $statement->fetch();
        return $result;
    }

    public static function get_track_categories($track_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_url, category_name FROM categories WHERE track_id=:track_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['track_id' => $track_id]);
        $results = $statement->fetchAll();
        foreach ($results as $result) {
            $categories[$result['category_url']] = $result['category_name'];
        }
        return $categories;
    }

    public static function get_category($category_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_name, category_url, track_id FROM categories WHERE category_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $category_id]);
        $result = $statement->fetch();
        return $result;
    }

    public static function get_category_id($track_id, $category_url) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_id FROM categories WHERE track_id=:track_id AND category_url=:category_url";
        $statement = $connection->prepare($sql);
        $statement->execute(['track_id' => $track_id ,'category_url' => $category_url]);
        $result = $statement->fetch();
        return $result['category_id'];
    }

    public static function count_problem_statements_in_category($category_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT problem_statement_id FROM problem_statements WHERE category_id=:category_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['category_id' => $category_id]);
        $result = $statement->fetchAll();
        return count($result);
    }

    public function get_problem_statements($category_id, $page_num) {
        $num_of_problems_in_category = self::count_problem_statements_in_category($category_id);

        if($num_of_problems_in_category == 0)
            return array();
        else if($page_num > ceil((float)$num_of_problems_in_category / RESULTS_PER_PAGE)) {
            return array();
        }
        else {
            $connection = DatabaseConnection::connection();
            $sql = "SELECT problem_statement_id, problem_statement_name, difficulty, points FROM problem_statements WHERE category_id=:category_id ORDER BY problem_statement_id ASC LIMIT :skip, :results_per_page";
            $statement = $connection->prepare($sql);
            $skip = (int)($page_num - 1) * RESULTS_PER_PAGE;
            $results_per_page = (int)RESULTS_PER_PAGE;
            $statement->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
            $statement->bindParam(':skip', $skip,  PDO::PARAM_INT);
            $statement->bindParam(':category_id', $category_id,  PDO::PARAM_INT);
            $statement->execute();

            $results = $statement->fetchAll();
            return $results;
        }
    }

    public static function problem_statement_exist($problem_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT problem_statement_id FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = count($statement->fetchAll());
        if($result == 1)
            return TRUE;
        else {
            return FALSE;
        }
    }

    public static function get_problem_statement($problem_id){
        $connection = DatabaseConnection::connection();
        $sql = "SELECT problem_statement_name, problem_statement_description, sample_input, sample_output, difficulty, points, category_id FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetch();
        return $result;
    }

    public static function get_sample_test_case($problem_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT sample_input, sample_output FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetch();
        return $result;
    }

    public static function get_test_cases($problem_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT input, output FROM test_cases WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetchAll();
        return $result;
    }

}

?>
