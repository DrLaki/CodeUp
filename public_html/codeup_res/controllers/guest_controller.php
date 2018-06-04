<?php

require_once("../codeup_res/controllers/controller.php");

define('MIN_PASSWORD_LEN', 8);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../codeup_res/php_mailer/src/Exception.php';
require '../codeup_res/php_mailer/src/PHPMailer.php';
require '../codeup_res/php_mailer/src/SMTP.php';

/**
 * GuestController class is used to render pages for guests of the platform
 */
class GuestController extends Controller{

    public function __construct() {

    }

    /**
     * [header_navigation function returns array of menu options user can choose from]
     * @return array
     */
    public function header_navigation() {
        return array('Home' => './', 'Explore' => 'explore',
                    'Login' => 'login', 'Signup' => 'register',
                    'Search' => 'search'); //'Search' shouldnt be in guest's navigation,
                    //but it is easier to see if my search button works this way,
                    //I dont want to have to register a user to check if it works
    }

    /**
     * [all_fields_are_set checks if all parameters of the POST request exist]
     * @return boolean
     */
    private function all_fields_are_set(){
            return isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])
                                             && isset($_POST['confirm_password']) && isset($_POST['country']);
    }

    /**
     * [all_field_are_filled checks if all parameters of the POST request are filled]
     * @return boolean
     */
    private function all_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])
                                              && !empty($_POST['confirm_password']) && !empty($_POST['country']);
    }

    /**
     * [password_confirm_matches_password checks if password confirm and password fields are same]
     * @return boolean
     */
    private function password_confirm_matches_password() {
        return $_POST['password'] == $_POST['confirm_password'];
    }



    /**
     * [send_email function is used for sending email to our users after their registration]
     * @param  string $email              [user's email address]
     * @param  string $registration_token [token used for account confirmation]
     * @return void
     */
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


    /**
     * [register_user helper function tries to register user]
     * @param  string $username
     * @param  string $password
     * @param  string $email
     * @param  int $country_id
     * @return void
     */
    private function register_user($username, $password, $email, $country_id) {
        require_once("../codeup_res/models/account_manager.php");
        require_once("../codeup_res/models/country_manager.php");

        if(AccountManager::username_exists($username)){
            $error_message = "Username already taken.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/register.php");
        }
        else if(AccountManager::email_exists($email)) {
            $error_message = "Account with that email already exists.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/register.php");
        }
        else if(strlen($password) < MIN_PASSWORD_LEN) {
            $error_message = "Password must be at least " . MIN_PASSWORD_LEN . " characters long.";
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/register.php");
        }
        else {
            $registration_token = hash('sha256', rand(1, 1000000000));
            $password = password_hash($password, PASSWORD_DEFAULT);
            AccountManager::register_user($username, $password, $email, $country_id, $registration_token);
            $this->send_email($email, $registration_token);
        }
    }

    /**
     * [register function renders the signup page and tries to register user if all parameters in the POST request exist]
     * @return void
     */
    public function register() {
        require_once("../codeup_res/models/country_manager.php");

        $error_message = "";

        if (! $this->all_fields_are_set ()) {
            //user vists signup page for the first time, nothing has been
            //submitted yet
            $countries = CountryManager::get_countries();
            require_once("../codeup_res/views/register.php");
        }
        else if (!$this->all_field_are_filled()){
            $error_message = "Please, fill in the form.";
            $countries = AccountManager::get_countries();
            require_once("../codeup_res/views/register.php");
        }
        else if (!$this->password_confirm_matches_password()){
            $error_message = "Passwords do not match.";
            $countries = AccountManager::get_countries();
            require_once("../codeup_res/views/register.php");
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






    /**
     * [all_login_fields_are_set checks if all parameters in the POST request exist]
     * @return boolean
     */
    private function all_login_fields_are_set(){
        return isset($_POST['username']) && isset($_POST['password']);
    }

    /**
     * [all_login_field_are_filled checks if all parameters in the POST request are filled]
     * @return boolean
     */
    private function all_login_field_are_filled() {
            return !empty($_POST['username']) && !empty($_POST['password']);
    }

    /**
     * [verify_login function tries to login user]
     * @param  string $username
     * @param  string $password
     * @return void
     */
    private function verify_login($username, $password) {
        require_once("../codeup_res/models/account_manager.php");

        if(!AccountManager::username_exists($username)) {
            $error_message = "You do not have an account.";
            require_once("../codeup_res/views/login.php");
            return;
        }

        if(!AccountManager::is_user_active($username)) {
            $error_message = "Please confirm your registration.";
            require_once("../codeup_res/views/login.php");
            return;
        }

        $hashed_password = AccountManager::get_hashed_password($username);
        if(password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = AccountManager::get_user_type($username);
            header("Location: ./");
            exit();
        }
        else {
            $error_message = "Incorrect username or password.";
            require_once("../codeup_res/views/login.php");
        }
    }

    /**
     * [login function renders the login page and tries to log in the user if all parameters in the POST request exist]
     * @return void
     */
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

    public function support() {
        echo '<div class="container container-main">
            <h2 class="form-title">You must login if you want to support us.</h2>
            </div>';
    }


    /**
     * [all_fields_are_set function checks if all parameters of the GET request exist]
     */
    private function all_account_confirmation_fields_are_set(){
        return isset($_GET['email']) && isset($_GET['registration_token']);
    }

    /**
     * [all_fields_are_filled function checks if all parameters of the GET request are filled]
     */
    function all_account_confirmation_field_are_filled() {
        return !empty($_GET['email']) && !empty($_GET['registration_token']);
    }


    public function account_confirmation() {
        if(!$this->all_account_confirmation_fields_are_set()) {
            echo '<div class="container container-main">
                <h2 class="form-title">Email or registration token does not exist.</h2>
                </div>';
        }
        else if(!$this->all_account_confirmation_field_are_filled()){
            echo '<div class="container container-main">
                <h2 class="form-title">Email or registration token does not exist.</h2>
                </div>';
        }
        else {
            require_once("../codeup_res/models/account_manager.php");
            $email = $_GET['email'];
            $registration_token = $_GET['registration_token'];
            echo $email." ".$registration_token;
            if(AccountManager::email_and_registration_token_exist($email, $registration_token)) {
                AccountManager::update_account_status($email);
                echo '<div class="container container-main">
                    <h2 class="form-title">You have completed your registration.</h2>
                    </div>';
            }
            else {
                echo '<div class="container container-main">
                    <h2 class="form-title">Email or registration token does not exist.</h2>
                    </div>';
            }
        }
    }


    //these are function that User or Admin implement
    public function user_profile() {
        require_once("../codeup_res/views/error404.php");
    }

    public function search_users() {
        require_once("../codeup_res/views/error404.php");
    }

    public function review_user_suggestions() {
        require_once("../codeup_res/views/error404.php");
    }

}
?>
