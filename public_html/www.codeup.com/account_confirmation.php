<?php

/**
 * [all_fields_are_set function checks if all parameters of the GET request exist]
 */
function all_fields_are_set(){
    return isset($_GET['email']) && isset($_GET['registration_token']);
}

/**
 * [all_fields_are_filled function checks if all parameters of the GET request are filled]
 */
function all_field_are_filled() {
    return !empty($_GET['email']) && !empty($_GET['registration_token']);
}

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "Account Confirmation",
    'css' => array('css/style.css', 'css/login.css'),
    'navigation' => $controller->header_navigation()
));

if(!all_fields_are_set()) {
    echo '<section id="main"><h2>Fuck off.</h2></section>';
}
else if(!all_field_are_filled()){
    echo '<section id="main"><h2>Fuck off.</h2></section>';
}
else {
    require_once("../codeup_res/models/account_manager.php");
    $email = $_GET['email'];
    $registration_token = $_GET['registration_token'];
    echo $email." ".$registration_token;
    if(AccountManager::email_and_registration_token_exist($email, $registration_token)) {
        AccountManager::update_account_status($email);
        echo '<section id="main"><h2>You have completed your registration. You can login now.</h2></section>';
    }
    else {
        echo '<section id="main"><h2>Fuck off.</h2></section>';
    }
}

render('footer');
?>
