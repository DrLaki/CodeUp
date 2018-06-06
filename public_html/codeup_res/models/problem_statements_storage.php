<?php

define("RESULTS_PER_PAGE", 5);

require_once("../codeup_res/database.php");

/**
 * ProblemStatementsStorage class is used for managing tracks, categories, problem_statements and test_cases tables in the database
 */
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

    /**
     * [get_tracks returns all tracks from the database]
     * @return array [associative array with track url as key and track name as value]
     */
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

    /**
     * [get_track_by_id function retrieves track from tracks table]
     * @param  int $track_id [track id is used to find the track in the database]
     * @return PDOStatement
     */
    public function get_track_by_id($track_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_url, track_name FROM tracks WHERE track_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $track_id]);
        $result = $statement->fetch();
        return $result;
    }

    /**
     * [get_track_by_url function retrieves track from tracks table]
     * @param  string $track_url [track url is used to find the track in the database]
     * @return PDOStatement
     */
    public function get_track_by_url($track_url) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_id, track_name FROM tracks WHERE track_url=:track_url";
        $statement = $connection->prepare($sql);
        $statement->execute(['track_url' => $track_url]);
        $result = $statement->fetch();
        return $result;
    }

    /**
     * [get_track_categories function is used to find all categories that belong to the given track]
     * @param  int $track_id [track id is used to find all categories that belong to the it]
     * @return array         [associative array with key as category url and value as category name]
     */
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

    /**
     * [get_category function retrieves category from the database with the given category id]
     * @param  int $category_id [category is used to find category name, url and track that this category belongs to]
     * @return array            [return associative array]
     */
    public static function get_category($category_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_name, category_url, track_id FROM categories WHERE category_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $category_id]);
        $result = $statement->fetch();
        return $result;
    }


    public static function get_category_id_by_problem_statement_id($problem_statement_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_id FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_statement_id]);
        $result = $statement->fetch();
        return $result['category_id'];
    }

    public static function get_track_id_by_category_id($category_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_id FROM categories WHERE category_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $category_id]);
        $result = $statement->fetch();
        return $result['track_id'];
    }

    /**
     * [get_category_id function retrieves category id]
     * @param  int $track_id        [used to find the category id]
     * @param  string $category_url [used to find the category id]
     * @return int                  [id of the found category]
     */
    public static function get_category_id($track_id, $category_url) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT category_id FROM categories WHERE track_id=:track_id AND category_url=:category_url";
        $statement = $connection->prepare($sql);
        $statement->execute(['track_id' => $track_id ,'category_url' => $category_url]);
        $result = $statement->fetch();
        return $result['category_id'];
    }

    /**
     * [count_problem_statements_in_category returns the number of problem statements in the given category]
     * @param  int $category_id [used to find all problem statements that belong to the category]
     * @return int
     */
    public static function count_problem_statements_in_category($category_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT problem_statement_id FROM problem_statements WHERE category_id=:category_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['category_id' => $category_id]);
        $result = $statement->fetchAll();
        return count($result);
    }

    /**
     * [get_problem_statements description]
     * @param  int $category_id [find problem statements that belong to this category]
     * @param  int $page_num    [page number used for navigation]
     * @return int              [number of problem statements to be displayed to the user]
     */
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

    /**
     * [problem_statement_exist checks if problem statement with the given id exists]
     * @param  int $problem_id
     * @return boolean
     */
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

    /**
     * [get_problem_statement function retrieves problem_statement based on the problem_statement_id]
     * @param  int $problem_id
     * @return array [associative array]
     */
    public static function get_problem_statement($problem_id){
        $connection = DatabaseConnection::connection();
        $sql = "SELECT problem_statement_name, problem_statement_description, sample_input, sample_output, difficulty, points, category_id FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetch();
        return $result;
    }

    /**
     * [get_sample_test_case returns sample input and sample output of the problem statement that is found with problem_id]
     * @param  int $problem_id
     * @return array [associative array]
     */
    public static function get_sample_test_case($problem_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT sample_input, sample_output, sample_case_exec_time FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetch();
        return $result;
    }

    /**
     * [get_test_cases returns all test cases that are used by the ptoblem statement with id as problem_id]
     * @param  int $problem_id
     * @return array             [associative array]
     */
    public static function get_test_cases($problem_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT input, output, test_case_exec_time FROM test_cases WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_id]);
        $result = $statement->fetchAll();
        return $result;
    }


    public static function mark_as_solved($username, $problem_statement_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT 1 FROM solved_problem_statements WHERE username=:username AND problem_statement_id=:problem_statement_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'problem_statement_id' => $problem_statement_id]);
        $row = $statement->fetch();
        if($row != FALSE) {
            return FALSE;
        }
        $sql = "INSERT INTO solved_problem_statements(username, problem_statement_id)
                        VALUES(:username, :problem_statement_id)";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'problem_statement_id' => $problem_statement_id]);
        return TRUE;
    }

    public static function add_points_to_users_track_points($username, $track_name, $points) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT 1 FROM users_track_points WHERE username=:username AND track_name=:track_name";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'track_name' => $track_name]);
        $row = $statement->fetch();
        if($row != FALSE) {
            $sql = "UPDATE users_track_points SET points=points+:points WHERE username=:username AND track_name=:track_name";
                    $statement->execute(['points' => $points,'username' => $username, 'track_name' => $track_name]);
                    return;
        }
        $sql = "INSERT INTO users_track_points(username, track_name, points)
                        VALUES(:username, :track_name, :points)";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'track_name' => $track_name, 'points' => $points]);
    }

    public static function get_points($problem_statement_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT points FROM problem_statements WHERE problem_statement_id=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(['id' => $problem_statement_id]);
        $result = $statement->fetch();
        return $result['points'];
    }

    public static function get_users_track_points($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT track_name, points FROM users_track_points WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $results = $statement->fetchAll();
        $track_points = array();
        foreach ($results as $result) {
            $track_points[$result['track_name']] = $result['points'];
        }
        return $track_points;
    }

}

?>
