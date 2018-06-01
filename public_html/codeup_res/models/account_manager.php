<?php


require_once("../codeup_res/database.php");

/**
 * AccountManager class is used for managing user accounts that are stored in the database
 */
class AccountManager {

    /**
     * [username_exists checks if the username exists in the database]
     * @param  string $username
     * @return boolean [TRUE if username exists, FALSE otherwise]
     */
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

    /**
     * [email_exists checks if the email exists in the database]
     * @param  string $email
     * @return boolean [TRUE if email exists, FALSE otherwise]
     */
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

    /**
     * [is_user_active checks if user has confirmed his registration]
     * @param  string  $username
     * @return boolean [TRUE if user is active, FALSE otherwise]
     */
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

    /**
     * [register_user function inserts user into the database]
     * @param  string $username [username to insert]
     * @param  string $password [password to insert]
     * @param  string $email    [email to insert]
     * @param  int $country_id  [country_id to insert]
     * @param  string $registration_token [registration_token to insert]
     * @return void
     */
    public static function register_user($username, $password, $email, $country_id, $registration_token){
        $connection = DatabaseConnection::connection();
        $sql = "INSERT INTO users(user_id, username, password, email, country_id, account_type, points, active, registration_token)
                VALUES(null, :username, :password, :email, :country_id, 'user', 0, 0, :registration_token)";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username, 'password' => $password, 'email' => $email, 'country_id' => $country_id, 'registration_token' => $registration_token]);
    }

    /**
     * [get_hashed_password returns password of the user with username]
     * @param  string $username
     * @return string
     */
    public static function get_hashed_password($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT password FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        return $result['password'];
    }

    /**
     * [get_user_type returns type of the user - admin or regular user]
     * @param  string $username
     * @return string
     */
    public static function get_user_type($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_type FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        return $result['user_type'];
    }

    /**
     * [email_and_registration_token_exist checks if registration token is in user table row which is found by the user's email address]
     * @param  string $email              [user's email addres]
     * @param  string $registration_token [token that is sent to the user's email address]
     * @return boolean
     */
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

    /**
     * [update_account_status function updates user in users table row found by email_address]
     * @param  string $email [user's email address]
     * @return void
     */
    public static function update_account_status($email) {
        $connection = DatabaseConnection::connection();
        $sql = "UPDATE users SET active = 1 WHERE email=:email";
        $statement = $connection->prepare($sql);
        $statement->execute(['email' => $email]);
    }
}

?>
