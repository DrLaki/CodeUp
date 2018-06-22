<?php

require_once("../codeup_res/controllers/controller.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../codeup_res/php_mailer/src/Exception.php';
require '../codeup_res/php_mailer/src/PHPMailer.php';
require '../codeup_res/php_mailer/src/SMTP.php';

/**
 * AdminController class is used to render pages for admins of the platform
 */
class AdminController extends Controller{


    public function header_navigation() {
        return array(
            'Home' => './',
            'MyProfile' => 'profile',
            'Explore' => 'explore',
            'Review suggestions' => 'review',
            'Add Content' => 'add_content',
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
            require_once("../codeup_res/models/user_suggestions_pool.php");
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

    private function all_support_fields_are_set() {
        return isset($_POST['selection']) && isset($_POST['form-title']) && isset($_POST['form-textarea']);
    }

    private function all_support_fields_are_filled() {
        return !empty($_POST['selection']) && !empty($_POST['form-title']) && !empty($_POST['form-textarea']);
    }

    private function search_field_is_set() {
        return isset($_GET['username']);
    }

    private function search_field_is_filled() {
        return !empty($_GET['username']);
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
        if(isset($_POST['promote'])) {
            AccountManager::promote_user($_POST['username']);
        }
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

    public function show_bug_reports() {
        require_once("../codeup_res/models/user_suggestions_pool.php");
        require_once("../codeup_res/models/account_manager.php");
        $bug_reports = UserSuggestionsPool::fetch_all_bug_reports();
        require_once("../codeup_res/templates.php");
        echo "
        <section id='main'>
            <div class='submissions-container'> " ;
        foreach ($bug_reports as $bug){
            $username = $bug['author'];
            $bug_id = $bug['bug_id'];
            $user_info = AccountManager::get_user_info($username);
            $title = $bug['title'];
            $body = $bug['body'];
            echo template_bugReport($title, $user_info, $body, $bug_id);
        }
        echo "
        </div>
            <!-- all submissions end -->
        </section>" ;

    }

    public function show_feature_requests() {
        require_once("../codeup_res/models/user_suggestions_pool.php");
        require_once("../codeup_res/models/account_manager.php");
        $feature_requests = UserSuggestionsPool::fetch_all_feature_requests();
        require_once("../codeup_res/templates.php");
        echo "
        <section id='main'>
            <div class='submissions-container'> " ;
        foreach ($feature_requests as $feature){
            $username = $feature['author'];
            $feature_id = $feature['feature_id'];
            $user_info = AccountManager::get_user_info($username);
            $title = $feature['title'];
            $body = $feature['body'];
            echo template_featureRequest($title, $user_info, $body, $feature_id);
        }
        echo "
        </div>
            <!-- all submissions end -->
        </section>" ;
    }

    private function new_form_track() {
        echo
        '<h2 class="form-title">New Track</h2>
        <form action="add_content" method="post" class="form content-form">
            <fieldset>
                <input name="track-name" type="text" required autocomplete="off" placeholder="TrackName"/>
                <input type="submit" class="login-button" name="add-new-track" value="Add" />
            </fieldset>
        </form>';
    }

    private function new_form_category() {
        require_once("../codeup_res/models/problem_statements_storage.php");
        $tracks = ProblemStatementsStorage::get_track_ids_and_names();
        echo
        '<h2 class="form-title">New Category</h2>
        <form action="add_content" method="post" class="form content-form">
            <fieldset>
                <select name="track">
                    <option value="default">--Choose Track--</option>';
                    foreach ($tracks as $track_id => $track_name) {
                        echo '<option value="' . $track_id . '">' . $track_name . '</option>';
                    }
        echo    '</select>
                <input name="category-name" type="text" required autocomplete="off" placeholder="CategoryName"/>
                <input type="submit" class="login-button" name="add-new-category" value="Add" />
            </fieldset>
        </form>';
    }

    private function choose_track($action_name) {
        require_once("../codeup_res/models/problem_statements_storage.php");
        $tracks = ProblemStatementsStorage::get_track_ids_and_names();
        echo
        '<h2 class="form-title">Choose Track</h2>
        <form action="add_content" method="post" class="form content-form">
            <fieldset>
                <select name="track">
                    <option value="default">--Choose Track--</option>';
                    foreach ($tracks as $track_id => $track_name) {
                        echo '<option value="' . $track_id . '">' . $track_name . '</option>';
                    }
        echo    '</select>
                <input type="hidden" name="select-action" value="' . $action_name . '"/>
                <input type="submit" class="login-button" value="Go" />
            </fieldset>
        </form>';
    }

    private function choose_category($action_name) {
        require_once("../codeup_res/models/problem_statements_storage.php");
        $track_id = $_POST['track'];
        $categories = ProblemStatementsStorage::get_track_category_ids_and_names($track_id);
        echo
        '
        <h2 class="form-title">Choose Category</h2>
        <form action="add_content" method="post" class="form content-form">
            <fieldset>
                <select name="category">
                    <option value="default">--Choose Category--</option>';
                    foreach ($categories as $category_id => $category_name) {
                        echo '<option value="' . $category_id . '">' . $category_name . '</option>';
                    }
        echo    '</select>
                <input type="hidden" name="select-action" value="' . $action_name . '"/>
                <input type="submit" class="login-button" value="Go" />
            </fieldset>
        </form>';
    }

    private function new_form_problem_statement() {
        if(isset($_POST['category'])) {
            if($_POST['category'] == 'default')
                header("Location: add_content");
            $_SESSION['category'] = $_POST['category'];
            echo
            '<h2 class="form-title">New Problem Statement</h2>
            <form action="add_content" method="post" class="form content-form">
                <fieldset>
                    <input name="problem-name" type="text" required autocomplete="off" placeholder="ProblemName"/>
                    <textarea name="problem-description" type="text" required autocomplete="off">Enter Problem Description ...</textarea>
                    <input name="difficulty" type="text" required autocomplete="off" placeholder="Difficulty"/>
                    <input name="points" type="text" required autocomplete="off" placeholder="Points"/>
                    <textarea name="input" type="text" required autocomplete="off">Sample Test Case Input ...</textarea>
                    <textarea name="output" required autocomplete="off">Sample Test Case Output ...</textarea>
                    <input name="time" type="text" required autocomplete="off" placeholder="ExecutionTime"/>
                    <input type="submit" class="login-button" name="add-new-problem" value="Add" />
                </fieldset>
            </form>';
        }
        else if(isset($_POST['track'])) {
            if($_POST['track'] == 'default')
                header("Location: add_content");
            $this->choose_category("add-problem-statement");
        }
        else {
            $this->choose_track("add-problem-statement");
        }
    }

    private function new_form_test_case() {
        if(isset($_POST['problem'])) {
            if($_POST['problem'] == 'default')
                header("Location: add_content");
            $_SESSION['problem'] = $_POST['problem'];
            echo
                '
                <h2 class="form-title">New Test Case</h2>
                <form action="add_content" method="post" class="form content-form">
                    <fieldset>
                        <textarea name="input" required autocomplete="off">Test Case Input ...</textarea>
                        <textarea name="output" required autocomplete="off">Test Case Output ...</textarea>
                        <input name="time" type="text" required autocomplete="off" placeholder="ExecutionTime"/>

                        <input type="submit" class="login-button" name="add-new-test-case" value="Add" />
                    </fieldset>
                </form>
                ';
        }
        else if(isset($_POST['category'])) {
            if($_POST['category'] == 'default')
                header("Location: add_content");
            $this->choose_problem_statement();
        }
        else if(isset($_POST['track'])) {
            if($_POST['track'] == 'default')
                header("Location: add_content");
            $this->choose_category("add-test-case");
        }
        else {
            $this->choose_track("add-test-case");
        }
    }

    private function choose_problem_statement() {
        require_once("../codeup_res/models/problem_statements_storage.php");
        $category_id = $_POST['category'];
        $problems = ProblemStatementsStorage::get_all_problem_statements($category_id);
        echo
        '
        <h2 class="form-title">Choose Problem Statement</h2>
        <form action="add_content" method="post" class="form content-form">
            <fieldset>
                <select name="problem">
                    <option value="default">--Choose Problem Statement--</option>';
                    foreach ($problems as $problem_id => $problem_name) {
                        echo '<option value="' . $problem_id . '">' . $problem_name . '</option>';
                    }
        echo    '</select>
                <input type="hidden" name="select-action" value="add-test-case"/>
                <input type="submit" class="login-button" value="Go" />
            </fieldset>
        </form>';
    }

    private function add_new_track() {
        $track_name = $_POST['track-name'];
        $track_url = str_replace(" ", "_",strtolower($track_name));
        if(!ProblemStatementsStorage::track_exists($track_name)){
            ProblemStatementsStorage::add_new_track($track_name, $track_url);
            $track = ProblemStatementsStorage::get_track_by_url($track_url);
            $track_id = $track['track_id'];
            ProblemStatementsStorage::add_new_category('WarmUp', 'warmup', $track_id);
            $php_code ='<?php
require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");
render("header", array(
    "title" => "' . $track_name . '",
    "css" => array("css/style.css", "css/track.css"),
    "navigation" => $controller->header_navigation()
));
$controller->track("' . $track_url . '");
render("footer");
?>';
            file_put_contents("./$track_url.php", $php_code);
        }
        else {
            require_once("../codeup_res/templates.php");
            echo template_ErrorMsg("Track with that name already exists.");
            exit;
        }
    }

    private function add_new_category() {
        $category_name = $_POST['category-name'];
        $category_url = str_replace(" ", "_",strtolower($category_name));
        $track_id = $_POST['track'];
        if(!ProblemStatementsStorage::category_exists($category_name, $track_id)) {
            ProblemStatementsStorage::add_new_category($category_name, $category_url, $track_id);
        }
        else {
            require_once("../codeup_res/templates.php");
            echo template_ErrorMsg("Category with that name already exists.");
            exit;
        }
    }

    private function add_new_problem_statement() {
        $problem_name = $_POST['problem-name'];
        $description = $_POST['problem-description'];
        $difficulty = $_POST['difficulty'];
        $points = $_POST['points'];
        $sample_input = $_POST['input'];
        $sample_output = $_POST['output'];
        $exec_time = $_POST['time'];
        $category_id = $_SESSION['category'];
        if(!ProblemStatementsStorage::problem_statement_exists($problem_name, $category_id)) {
            ProblemStatementsStorage::add_new_problem_statement($problem_name, $description, $points, $difficulty, $sample_input, $sample_output, $exec_time, $category_id);
            $problem_statement_id = ProblemStatementsStorage::get_problem_statement_id($problem_name, $category_id);
            ProblemStatementsStorage::add_new_test_case($sample_input, $sample_output, $exec_time, $problem_statement_id);
        }
        else {
            require_once("../codeup_res/templates.php");
            echo template_ErrorMsg("Problem with that name already exists.");
            exit;
        }
    }

    private function add_new_test_case() {
        $input = $_POST['input'];
        $output = $_POST['output'];
        $exec_time = $_POST['time'];
        $problem_statement_id = $_SESSION['problem'];
        ProblemStatementsStorage::add_new_test_case($input, $output, $exec_time, $problem_statement_id);
    }

    private function handle_action() {
        if(isset($_POST['add-new-track'])) {
            $this->add_new_track();
            header("Location: add_content");
            exit;
        }
        else if(isset($_POST['add-new-category'])) {
            $this->add_new_category();
            header("Location: add_content");
            exit;
        }
        else if(isset($_POST['add-new-problem'])) {
            $this->add_new_problem_statement();
            header("Location: add_content");
            exit;
        }
        else if(isset($_POST['add-new-test-case'])) {
            $this->add_new_test_case();
            header("Location: add_content");
            exit;
        }
    }

    private function new_form($selected_action) {
        $this->handle_action();
        if($selected_action == "") {
            return;
        }
        else if($selected_action == "add-track")
            $this->new_form_track();
        else if($selected_action == "add-category")
            $this->new_form_category();
        else if($selected_action == "add-problem-statement") {
            $this->new_form_problem_statement();
        }
        else if($selected_action == "add-test-case") {
            $this->new_form_test_case();
        }
    }

    public function add_content() {
        require_once("../codeup_res/models/problem_statements_storage.php");
        $error_message = "";
        $selected_action = "";
        if(isset($_POST['select-action'])) {
            $selected_action = $_POST['select-action'];
        }
        require_once("../codeup_res/views/add_content.php");
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


    private function send_email_to_developer($subject, $body, $email) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure= 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'pied.piper.codeup@gmail.com';
        $mail->Password = 'pp_codeup';
        $mail->SetFrom('no-reply@codeup.com');
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            echo "Mailer error: " . $mail->ErrorInfo();
        }
    }

    public function handle_suggestions() {
        if (isset($_POST['submission-type'])){
            $title = $_POST['title'];
            $body = $_POST['body'];
            $submission_type = $_POST['submission-type'];
            if ($submission_type == 'bug-report'){
                require_once("../codeup_res/models/user_suggestions_pool.php");
                require_once("../codeup_res/models/developers.php");
                $bug_id = $_POST['submission-id'];
                if(isset($_POST['accept'])) {
                    UserSuggestionsPool::accept_bug_report($bug_id);
                    $emails = Developers::get_all_developer_emails();
                    foreach ($emails as $email) {
                        $this->send_email_to_developer("Bug Report - $title", $body, $email);
                    }
                }
                else {
                    UserSuggestionsPool::reject_bug_report($bug_id);
                }
            }
            else if ($submission_type == 'feature-request'){
                require_once("../codeup_res/models/user_suggestions_pool.php");
                require_once("../codeup_res/models/developers.php");
                $feature_req_id = $_POST['submission-id'];
                if(isset($_POST['accept'])) {
                    UserSuggestionsPool::accept_feature_req($feature_req_id);
                    $emails = Developers::get_all_developer_emails();
                    foreach ($emails as $email) {
                        $this->send_email_to_developer("Feature Request - $title", $body, $email);
                    }
                }
                else {
                    UserSuggestionsPool::reject_feature_req($feature_req_id);
                }

            }
            else {
                echo template_ErrorMsg("Submission type is neither bug-report nor feature-request.");
            }
            //Tehnici nisam proverio da li je doslo do neke greske sa bazom, to svakako treba uraditi
            echo template_SuccessMsg("Success!!");
        }
        else {
            echo "Some kind of error occured!!!!";
            require_once("../codeup_res/templates.php");
            echo templatePage_ErrorMsg("Access denied");
        }
    }



    //these are functions that Guest implements
    public function account_confirmation() {
        require_once("../codeup_res/views/error404.php");
    }

    public function register() {
        require_once("../codeup_res/views/error404.php");
    }

    public function login() {
        require_once("../codeup_res/views/error404.php");
    }
}

?>
