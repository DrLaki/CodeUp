<?php

require_once("../codeup_res/database.php");

class UserSuggestionsPool {
    public static function add_bug_report($title, $bug_report_message, $sent_by_user) {
        $connection = DatabaseConnection::connection();
        $sql = "INSERT INTO bug_reports(bug_report_id, bug_report_title, bug_report_message, username)
                VALUES(null, :title, :message, :username)";
        $statement = $connection->prepare($sql);
        $statement->execute(['title' => $title, 'message' => $bug_report_message, 'username' => $sent_by_user]);
    }


    public static function add_feature_request($title, $feature_request_message, $sent_by_user) {
        $connection = DatabaseConnection::connection();
        $sql = "INSERT INTO feature_requests(feature_request_id, feature_request_title, feature_request_message, username)
                VALUES(null, :title, :message, :username)";
        $statement = $connection->prepare($sql);
        $statement->execute(['title' => $title, 'message' => $feature_request_message, 'username' => $sent_by_user]);
    }

    public static function fetch_all_bug_reports(){
        $connection = DatabaseConnection::connection();
        $query_text = "SELECT bug_report_id, bug_report_title, bug_report_message, username FROM bug reports";
        $query = $connection->prepare($query_text);
        $query->execute();
        $bug_reports = array();
        $query_result = $query->fetchAll();
        foreach ($query_result as $row) {
            $bug_reports[$row['bug_report_id']] =
                array($row['bug_report_title'], $row['bug_report_message'], $row['username']);
        }
        return $bug_reports;
    }


    private static function fetch_all ($table_name, $fields){

    }
}

?>
