<?php
class UserManager {
    public static function username_exists($username) {
        $pdo = DatabaseConnection::connection();
        $query = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $username]);
        $user = $query->fetch();
        if(!empty($user))
            return TRUE;
        else
            return FALSE;
    }

    public static function email_exists($email) {
        $pdo = DatabaseConnection::connection();
        $query = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        $user = $query->fetch();
        if(!empty($user))
            return TRUE;
        else
            return FALSE;
    }

    public static function register_user($username, $email, $password) {
        /** Returns an error message in case of an error,
        * and an empty message otherwise */
        if(!self::username_exists($username)) {
            if(!self::email_exists($email)) {
                define('MIN_PASSWORD_LEN', 7);
                if(strlen($password) >=

                 MIN_PASSWORD_LEN) {
                    $hash = md5( rand(0,1000000) );

                    $pdo = DatabaseConnection::connection();
                    $query = $pdo->prepare('INSERT INTO users(username, password, email, hash) VALUES
                        (:username, :password, :email, :hash)
                    ');
                    $query->execute(array(
                        'username' => $username,
                        'password' => $password,
                        'email' => $email,
                        'hash' => $hash
                    ));


                    return "";
                }
                else {
                    return "Password must be at least" . MIN_PASSWORD_LEN . " characters long.";
                }
            }
            else {
                return "Username or email already taken.";
            }
        }
        else {
            return "Username or email already taken.";
        }
    }


    public static function get_user_from_database($username) {

    }
}

 ?>
