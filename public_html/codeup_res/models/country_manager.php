<?php

require_once("../codeup_res/database.php");

/**
 * [CountryManager class is used for managing countries table in our database]
 */
class CountryManager {

    /**
     * [get_countries returns all countries located in the database]
     * @return array
     */
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

    /**
     * [get_country_id returns country id based on the given country name]
     * @param  string $country_name [name of the country]
     * @return int
     */
    public static function get_country_id($country_name) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT country_id FROM apps_countries WHERE country_name=:country_name";
        $statement = $connection->prepare($sql);
        $statement->execute(['country_name' => $country_name]);
        $country_id = $statement->fetch()['country_id'];
        return $country_id;
    }
}
 ?>
