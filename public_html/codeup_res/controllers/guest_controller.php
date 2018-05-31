<?php
define('MIN_PASSWORD_LEN', 8);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../codeup_res/php_mailer/src/Exception.php';
require '../codeup_res/php_mailer/src/PHPMailer.php';
require '../codeup_res/php_mailer/src/SMTP.php';

class GuestController {

    public function __construct() {

    }

    // guest navigation
    public function header_navigation() {
        return array('Home', 'Explore', 'Login', 'Signup');
    }

    //style sheets for index.php
    public function index_style_sheets() {
        return array('css/style.css', 'css/index.css');
    }

    public function index() {
        require_once("../codeup_res/views/guest_index.php");
    }





    //register helper functions
    public function register_style_sheets() {
        return array('css/style.css', 'css/login.css');
    }

    private function all_fields_are_set(){
            return isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])
                                             && isset($_POST['confirm_password']) && isset($_POST['country']);
    }
    private function all_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])
                                              && !empty($_POST['confirm_password']) && !empty($_POST['country']);
    }

    private function password_confirm_matches_password() {
        return $_POST['password'] == $_POST['confirm_password'];
    }

    private function send_email($email, $registration_token) {
        $url = "localhost/www.codeup.com/account_confirmation?email=$email&registration_token=$registration_token";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure= 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'pied.piper.codeup@gmail.com';
        $mail->Password = 'pp_codeup';
        $mail->SetFrom('no-reply@codeup.com');
        $mail->Subject ='Account Confirmation';
        $mail->Body = "Follow the given link to finish your registration: " . $url;
        $mail->AddAddress($email);

        if(!$mail->Send()) {
            echo "Mailer error: " . $mail->ErrorInfo();
        }
        else {
            echo "Email with confirmation details is sent to your email address.";
        }
    }
    private function register_user($username, $password, $email, $country_id) {
        require_once("../codeup_res/models/account_manager.php");
        require_once("../codeup_res/models/country_manager.php");

        if(AccountManager::username_exists($username)){
            $error_message = "Username already taken.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else if(AccountManager::email_exists($email)) {
            $error_message = "Account with that email already exists.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else if(strlen($password) < MIN_PASSWORD_LEN) {
            $error_message = "Password must be at least " . MIN_PASSWORD_LEN . " characters long.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else {
            $registration_token = hash('sha256', rand(1, 1000000000));
            $password = password_hash($password, PASSWORD_DEFAULT);
            AccountManager::register_user($username, $password, $email, $country_id, $registration_token);
            $this->send_email($email, $registration_token);
        }
    }

    public function register() {
        require_once("../codeup_res/models/country_manager.php");

        $error_message = "";

        if (! $this->all_fields_are_set ()) {
            //user vists signup page for the first time, nothing has been
            //submitted yet
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else if (!$this->all_field_are_filled()){
            $error_message = "Please, fill in the form.";
            $countries = AccountManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else if (!$this->password_confirm_matches_password()){
            $error_message = "Passwords do not match.";
            $countries = AccountManager::get_countries();
            require_once("../codeup_res/views/signup.php");
        }
        else {
            //valid registration form, check if an account with the same
            //username or password already exists
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $country_id = CountryManager::get_country_id($_POST['country']);

            $this->register_user($username, $password, $email, $country_id);
        }
    }






    //login helper functions
    private function all_login_fields_are_set(){
        return isset($_POST['username']) && isset($_POST['password']);
    }


    private function all_login_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['password']);
    }

    public function login_style_sheets() {
        return array('css/style.css', 'css/login.css');
    }

    private function verify_login($username, $password) {
        require_once("../codeup_res/models/account_manager.php");

        if(!AccountManager::is_user_active($username)) {
            $error_message = "Please confirm your registration.";
            require_once("../codeup_res/views/login.php");
            return;
        }

        $hashed_password = AccountManager::get_hashed_password($username);
        if(password_verify($password, $hashed_password)) {
            $_SESSION['user_type'] = AccountManager::get_user_type($username);
            header("Location: ./");
        }
        else {
            $error_message = "Incorrect username or password.";
            require_once("../codeup_res/views/login.php");
        }
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
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->verify_login($username, $password);
        }
    }
}
?>
