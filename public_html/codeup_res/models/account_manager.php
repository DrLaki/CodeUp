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
        $sql = "SELECT account_type FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        return $result['account_type'];
    }

    public static function get_user_info($username){
        $connection = DatabaseConnection::connection();
        $sql = "SELECT * from users where username=:username";
        $query = $connection->prepare($sql);
        $query->execute(['username' => $username]);
        $user_info = $query->fetch();
        return $user_info;
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

    public static function get_all_users() {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_id, username, points FROM users";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();
        $users = array();
        foreach ($results as $result) {
            $users[$result['user_id']] = array($result['username'], $result['points']);
        }
        return $users;
    }

    public static function get_users_by_username($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT user_id, username, points FROM users WHERE username LIKE :username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => '%' . $username . '%']);
        $results = $statement->fetchAll();
        $users = array();
        foreach ($results as $result) {
            $users[$result['user_id']] = array($result['username'], $result['points']);
        }
        return $users;
    }

    public static function get_country_and_points($username) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT country_id, points FROM users WHERE username LIKE :username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
        $result = $statement->fetch();
        $country_and_points = array();
        $country_and_points['points'] = $result['points'];
        $country_id = $result['country_id'];

        $sql = "SELECT country_name FROM apps_countries WHERE country_id=:country_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['country_id' => $country_id]);
        $result = $statement->fetch();

        $country_and_points['country'] = $result['country_name'];
        return $country_and_points;
    }

    public static function add_points_to_user($username, $points) {
        $connection = DatabaseConnection::connection();
        $sql = "UPDATE users SET points=points+:points WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['points' => $points, 'username' => $username]);
    }

    public static function get_username_by_user_id($user_id) {
        $connection = DatabaseConnection::connection();
        $sql = "SELECT username FROM users WHERE user_id=:user_id";
        $statement = $connection->prepare($sql);
        $statement->execute(['user_id' => $user_id]);
        $row = $statement->fetch();
        if($row == FALSE) {
            return FALSE;
        }
        return $row['username'];
    }

    public static function promote_user($username) {
        $connection = DatabaseConnection::connection();
        $sql = "UPDATE users SET account_type='admin' WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
    }

    public static function delete_user($username) {
        $connection = DatabaseConnection::connection();
        $sql = "DELETE FROM users WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);

        $sql = "DELETE FROM users_track_points WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);

        $sql = "DELETE FROM solved_problem_statements WHERE username=:username";
        $statement = $connection->prepare($sql);
        $statement->execute(['username' => $username]);
    }

}

?>
