<?php

class Developers {


    public static function get_all_developer_emails() {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT email FROM developers";
        $query = $connection->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();
        $emails = array();
        foreach ($results as $result) {
            $emails[] = $result['email'];
        }
        return $emails;
    }
}


?>
