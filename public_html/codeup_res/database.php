<?php

/**
 * [DatabaseConnection class extends PDO and is used for object oriented aproach of querying the database]
 * [This class is Signleton design pattern]
 */
class DatabaseConnection extends PDO {


    private function __construct() {

    }
    private function __clone() {

    }

    private static $connection = NULL;

    /**
     * [connection function instantiate connection to the database if the connection is not yet established, and returns DatabaseConnection instance]
     * @param  string $file [.ini file used for storing database configuration - security of the platform is our biggest concern]
     * @return DatabaseConnection
     */
    public static function connection($file = "../codeup_res/database_settings.ini") {
        if(self::$connection == NULL) {
            $settings = parse_ini_file($file, TRUE);
            if(!$settings) {
                throw new exception("Unable to open " . $file . ".");
            }
            else {
                $dsn = $settings['database']['driver']
                        . ':host=' . $settings['database']['host']
                        . ';dbname=' . $settings['database']['schema'];
                self::$connection = new PDO($dsn, $settings['database']['username'], $settings['database']['password']);
            }
        }
        return self::$connection;
    }
}

 ?>
