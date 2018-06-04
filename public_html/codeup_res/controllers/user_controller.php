<?php

require_once("../codeup_res/models/user_suggestions_pool.php");
require_once("../codeup_res/controllers/controller.php");

/**
 * UserController class is used to render pages for user of the platform
 */
class UserController extends Controller {

    public function header_navigation() {
        return array(
            'Home' => '',
            'MyProfile' => 'user_profile',
            'Explore' => 'explore',
            'Search' => 'search',
            'Logout' => 'logout'
        );
    }


    public function user_profile() {

    }

    public function search_users() {

    }



    private function all_support_fields_are_set() {
        return isset($_POST['selection']) && isset($_POST['form-title']) && isset($_POST['form-textarea']);
    }

    private function all_support_fields_are_filled() {
        return !empty($_POST['selection']) && !empty($_POST['form-title']) && !empty($_POST['form-textarea']);
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
            $selection = $_POST['selection'];
            //$POST['selection'] determines if user sent bug report or feature request
            $sent_by_user = $_SESSION['username'];
            if($selection == "report-problem") {
                UserSuggestionsPool::add_bug_report($title, $form_content, $sent_by_user);
            }
            else {
                UserSuggestionsPool::add_feature_request($title, $form_content, $sent_by_user);
            }
            sleep(2);
            header("Location: support");
            exit();
        }
    }


    //these are the functions that Admin or Guest implement
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

}


?>
