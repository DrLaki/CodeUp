<?php

class AccountManager {

    private static $users = array(
        array("username" => "dexa96", "password" => "12345678", "email" => "dexa96@mail.com", "type" => "user"),
        array("username" => "deki96", "password" => "12345678", "email" => "deki96@mail.com", "type" => "admin"),
        array("username" => "laki96", "password" => "12345678", "email" => "laki96@mail.com", "type" => "user"),
        array("username" => "drLaki", "password" => "12345678", "email" => "drLaki@mail.com", "type" => "admin"),
    );

    public static function username_exists($username) {

        foreach (self::$users as $user) {
            if($user["username"] == $username)
                return TRUE;
        }
        return FALSE;
    }

    public static function email_exists($email) {
        foreach (self::$users as $user) {
            if($user["email"] == $email)
                return TRUE;
        }
        return FALSE;
    }

    public static function register_user($username, $email, $password){
        define('MIN_PASSWORD_LEN', 8);

        if(self::username_exists($username)) {
            return "Username already taken.";
        }
        else if(self::email_exists($email)) {
            return "Email already exists.";
        }
        else if(strlen($password) < MIN_PASSWORD_LEN) {
            return "Password must be at least " . MIN_PASSWORD_LEN . " characters long.";
        }
        else {
            //sve okej, registruj korisnika

            return "";
        }
    }

    public static function login($username, $password) {
        foreach (self::$users as $user) {
            if($user["username"] == $username && $user["password"] == $password)
                return TRUE;
        }
        return FALSE;
    }

    public static function user_type($username) {
        foreach (self::$users as $user) {
            if($user["username"] == $username)
                return $user["type"];
        }
    }

}

?>
