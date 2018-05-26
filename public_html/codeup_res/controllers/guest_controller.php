<?php

class GuestController {

    public function __construct() {

    }

    // navigacija koju treba gost da vidi
    public function header_navigation() {
        return array('Home', 'Explore', 'Login', 'Signup');
    }

    //style sheets za index.php
    public function index_style_sheets() {
        return array('style.css', 'index.css');
    }

    public function index() {
        require_once("../codeup_res/views/guest_index.php");
    }

    //style sheets za explore.php
    public function explore_style_sheets() {
        return array('style.css', 'explore.css');
    }

    public function explore() {
        require_once("../codeup_res/views/explore.php");
    }


    public function register_style_sheets() {
        return array('style.css', 'login.css');
    }

    private function all_fields_are_set(){
            return isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']);
    }
    private function all_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf']);
    }

    private function password_confirm_matches_password() {
        return $_POST['password'] == $_POST['password_conf'];
    }


    public function register() {
        $error_message = "";

        if (! $this->all_fields_are_set ()) {
            //user vists signup page for the first time, nothing has been
            //submitted yet
                require_once("../codeup_res/views/signup.php");
        }
        else if (!$this->all_field_are_filled()){
            $error_message = "Please, fill in the form.";
            require_once("../codeup_res/views/signup.php");
        }
        else if (!$this->password_confirm_matches_password()){
            $error_message = "Passwords do not match.";
            require_once("../codeup_res/views/signup.php");
        }
        else {
            //valid registration form, check if an account with the same
            //username or password already email_exists
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            //preko user.php dohvatamo podatke iz baze
            require_once("../codeup_res/models/account_manager.php");

            //vraca prazan message ako je sve okej
            // a u suprotnom vraca teskst greske
            //TODO: throw exception instead of returning string when error occurs
            $error_message = AccountManager::register_user($username, $email, $password);
            if(empty($error_message)) {
                //TODO: korisnik je registrovan, sacekati jos confirmation mail
                echo '<p>You are registered.<p>';
            }
            else {
                require_once("../codeup_res/views/signup.php");
            }
        }
    }


    private function all_login_fields_are_set(){
        return isset($_POST['username']) && isset($_POST['password']);
    }


    private function all_login_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['password']);
    }

    public function login_style_sheets() {
        return array('style.css', 'login.css');
    }

    public function login() {
        $error_message = "";
        if(! $this->all_login_fields_are_set()) {
            require_once("../codeup_res/views/login.php");
        }
        else if(! $this->all_login_field_are_filled()) {
            $error_message = "Please, fill in the form.";
            require_once("../codeup_res/views/login.php");
        }
        else {
            require_once("../codeup_res/models/account_manager.php");

            $username = $_POST['username'];
            $password = $_POST['password'];

            if(AccountManager::login($username, $password)) {
                $_SESSION['user'] = AccountManager::user_type($username);
                header("Location: ./");
            }
            else {
                $error_message = "Incorrect username or password.";
                require_once("../codeup_res/views/login.php");
            }
        }

    }
}
?>
