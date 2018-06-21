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
        // bug_report_id 	bug_report_title 	bug_report_message 	username
        $query_text = "SELECT bug_report_id, bug_report_title, bug_report_message, username FROM bug_reports";
        $query = $connection->prepare($query_text);
        $query->execute();
        $bug_reports = array();
        $query_result = $query->fetchAll();
        foreach ($query_result as $row) {
            array_push($bug_reports,
                array('title' => $row['bug_report_title'],
                'body' => $row['bug_report_message'],
                'author' => $row['username'],
                'bug_id' => $row['bug_report_id']));
        }
        return $bug_reports;
    }


    public static function accept_bug_report($bug_id){
        //TODO: notify developers
        UserSuggestionsPool::delete_bug_report($bug_id);
    }

    public static function reject_bug_report($bug_id){
        UserSuggestionsPool::delete_bug_report($bug_id);
    }

    private static function delete_bug_report($id){
        $connection = DatabaseConnection::connection();
        $sql = "DELETE FROM bug_reports WHERE bug_report_id = :id";
        $query = $connection->prepare($sql);
        $query->execute(['id' => $id]);
    }

    public static function accept_feature_req($feature_req_id){
        //TODO: notify developers
        UserSuggestionsPool::delete_feature_req($feature_req_id);
    }

    public static function reject_feature_req($feature_req_id){
        UserSuggestionsPool::delete_feature_req($feature_req_id);
    }


    private static function delete_feature_req($id){
        $connection = DatabaseConnection::connection();
        $sql = "DELETE FROM feature_requests WHERE feature_request_id = :id";
        $query = $connection->prepare($sql);
        $query->execute(['id' => $id]);
    }

}

?>
