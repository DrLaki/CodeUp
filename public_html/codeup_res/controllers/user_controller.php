<?php

require_once("../codeup_res/controllers/controller.php");

/**
 * UserController class is used to render pages for user of the platform
 */
class UserController extends Controller {

    public function header_navigation() {
        return array(
            'Home' => '',
            'MyProfile' => 'user',
            'Explore' => 'explore',
            'Search users' => 'search_users',
            'Logout' => 'logout'
        );
    }


    public function user() {

    }

    public function support() {

    }



}


?>
