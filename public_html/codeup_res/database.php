<?php

class DatabaseConnection extends PDO {
    private function __construct() {

    }
    private function __clone() {

    }


    private static $connection = NULL;

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
