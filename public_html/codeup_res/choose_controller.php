<?php
$controller = NULL;

session_start();
unset($_SESSION['user']);
if(!isset($_SESSION['user'])) {
    require_once("../codeup_res/controllers/guest_controller.php");
    $controller = new GuestController();
}
else if($_SESSION['user'] == 'admin') {
    require_once("../codeup_res/controllers/admin_controller.php");
    $controller = new AdminController();
}
else {
    require_once("../codeup_res/controllers/user_controller.php");
    $controller = new UserController();
}
?>
