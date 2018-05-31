<?php

require_once("../codeup_res/database.php");

class CountryManager {
    public static function get_countries() {
        $connection = DatabaseConnection::connection();
        $statement = $connection->query("SELECT country_name FROM apps_countries");
        $results = $statement->fetchAll();
        $countries = array();
        foreach ($results as $result) {
            $countries[] = $result['country_name'];
        }
        return $countries;
    }

    public static function get_country_id($country_name) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT country_id FROM apps_countries WHERE country_name=:country_name";
        $statement = $connection->prepare($sql);
        $statement->execute(['country_name' => $country_name]);
        $country = $statement->fetch()['country_id'];
        return $country;
    }
}
 ?>
