<?php

require_once("../codeup_res/database.php");

class AccountManager {

    public static function username_exists($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_id FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $count = count($statement->fetchAll());
        if($count == 1)
            return TRUE;
        else
            return FALSE;
    }

    public static function email_exists($email) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_id FROM users WHERE email=:email";
        $statement = $connection->prepare($sql);
        $statement->execute(['email' => $email]);
        $count = count($statement->fetchAll());
        if($count == 1)
            return TRUE;
        else
            return FALSE;
    }

    public static function is_user_active($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT active FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetchAll();
        $count = count($result);
        if($count == 1 && $result[0]['active'] == 1)
            return TRUE;
        else
            return FALSE;
    }

    public static function register_user($username, $password, $email, $country_id, $registration_token){
        $connection = DatabaseConnection::connection();
        $sql = "INSERT INTO users(user_id, username, password, email, country_id, account_type, points, active, registration_token)
                VALUES(null, :username, :password, :email, :country_id, 'user', 0, 0, :registration_token)";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'password' => $password, 'email' => $email, 'country_id' => $country_id, 'registration_token' => $registration_token]);
    }

    public static function get_hashed_password($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT password FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        return $result['password'];
    }

    public static function get_user_type($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_type FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        return $result['password'];
    }

    public static function email_and_registration_token_exist($email, $registration_token) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT email, registration_token, active FROM users WHERE email=:email AND registration_token=:registration_token";
        $statement = $connection->prepare($sql);
        $statement->execute(['email' => $email, 'registration_token' => $registration_token]);
        $result = $statement->fetchAll();
        $count = count($result);
        if($count == 1 && $result[0]['active'] == 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }


    public static function update_account_status($email) {
        $connection = DatabaseConnection::connection();
        $sql = "UPDATE users SET active = 1 WHERE email=:email";
        $statement = $connection->prepare($sql);
        $statement->execute(['email' => $email]);
    }
}

?>
