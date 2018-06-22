<?php

require_once("../codeup_res/models/user_suggestions_pool.php");
require_once("../codeup_res/controllers/controller.php");

/**
 * UserController class is used to render pages for user of the platform
 */
class UserController extends Controller {


    public function header_navigation() {
        return array(
            'Home' => './',
            'MyProfile' => 'profile',
            'Explore' => 'explore',
            'Search' => 'search',
            'Logout' => 'logout'
        );
    }



    public function support() {
        $error_message = "";
        if(!$this->all_support_fields_are_set()) {
            require_once("../codeup_res/views/support.php");
        }
        else if(!$this->all_support_fields_are_filled()) {
            $error_message = "Please fill in the form.";
            require_once("../codeup_res/views/support.php");
        }
        else {
            $title = $_POST['form-title'];
            $form_content = $_POST['form-textarea'];
            //$POST['selection'] determines if user sent bug report or feature request
            $selection = $_POST['selection'];
            $sent_by_user = $_SESSION['username'];

            if($selection == "report-problem") {
                UserSuggestionsPool::add_bug_report($title, $form_content, $sent_by_user);
            }
            else {
                UserSuggestionsPool::add_feature_request($title, $form_content, $sent_by_user);
            }
            echo '<p style="text-align:center">You have successfully submited the form. You will be redirected in 5 seconds.</p>';
            sleep(5);
            header("Location: support");
            exit();
        }
    }

    private function all_support_fields_are_set() {
        return isset($_POST['selection']) && isset($_POST['form-title']) && isset($_POST['form-textarea']);
    }

    private function all_support_fields_are_filled() {
        return !empty($_POST['selection']) && !empty($_POST['form-title']) && !empty($_POST['form-textarea']);
    }



    public function search_users() {
        require_once("../codeup_res/models/account_manager.php");
        if(!$this->search_field_is_set() || !$this->search_field_is_filled()) {
            $users = AccountManager::get_all_users();
            require_once("../codeup_res/views/search_users.php");
        }
        else {
            $username = $_GET['username'];
            $users = AccountManager::get_users_by_username($username);
            require_once("../codeup_res/views/search_users.php");
        }
    }

    private function search_field_is_set() {
        return isset($_GET['username']);
    }

    private function search_field_is_filled() {
        return !empty($_GET['username']);
    }



    public function user_profile() {
        require_once("../codeup_res/models/account_manager.php");
        require_once("../codeup_res/models/problem_statements_storage.php");
        if(isset($_POST['delete'])){
            $username = $_SESSION['username'];
            AccountManager::delete_user($username);
            session_destroy();
            header("Location: ./");
        }
        $username = "";
        $account_type = "";
        if(isset($_GET['id'])) {
            $username = AccountManager::get_username_by_user_id($_GET['id']);
            if($username == FALSE) {
                require_once("../codeup_res/views/error404.php");
                return;
            }
        }
        else {
            $username = $_SESSION['username'];
        }
        $account_type = AccountManager::get_user_type($username);
        $country_and_points = AccountManager::get_country_and_points($username);
        $country = $country_and_points['country'];
        $points = $country_and_points['points'];
        $track_points = ProblemStatementsStorage::get_users_track_points($username);
        require_once("../codeup_res/views/profile.php");
    }


    public function change_password() {
        require_once("../codeup_res/models/account_manager.php");
        if(!isset($_POST['submit'])){
            $error_message = "";
            require_once("../codeup_res/views/change_password.php");
            exit;
        }
        if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['new_confirm_password'])){
            $error_message = "Please, fill out all of the fields.";
            require_once("../codeup_res/views/change_password.php");
        }
        else{
            $username = $_SESSION['username'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['new_confirm_password'];
            $hashed_password = AccountManager::get_hashed_password($username);
            if(!password_verify($old_password, $hashed_password)){
                $error_message = "Incorrect old password.";
                require_once("../codeup_res/views/change_password.php");
            }
            else if($new_password != $confirm_password) {
                $error_message = "New password and confirmation password do not match.";
                require_once("../codeup_res/views/change_password.php");
            }
            else if(strlen($new_password) < MIN_PASSWORD_LEN) {
                $error_message = "Password needs to be at least ".MIN_PASSWORD_LEN." characters long.";
                require_once("../codeup_res/views/change_password.php");
            }
            else {
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                AccountManager::update_password($username, $new_password);
                $error_message = "You have successfully changed your password";
                require_once("../codeup_res/views/change_password.php");
            }
        }
    }

    //these are the functions that Admin or Guest implement
    public function show_bug_reports(){
        require_once("../codeup_res/views/error404.php");
    }
    public function account_confirmation() {
        require_once("../codeup_res/views/error404.php");
    }
    public function register() {
        require_once("../codeup_res/views/error404.php");
    }
    public function login() {
        require_once("../codeup_res/views/error404.php");
    }
    public function review_user_suggestions() {
        require_once("../codeup_res/views/error404.php");
    }
    public function add_content() {
        require_once("../codeup_res/views/error404.php");
    }

}


?>
