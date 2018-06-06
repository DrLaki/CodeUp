<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");


//ako guest pokusava da pogleda neciju profilnu stranicu, treba da mu se zabrani pristup.
//Dakle, ovaj deo php koda ispod komentara ne sme da se izvrsava, tj.    pre ovog komentara treba
//da se uradi provera da li korisnik sme da gleda progile drugih ljudi.
render('header', array(
    'title' => "My Profile",
    'css' => array('css/style.css'),
    'navigation' => $controller->header_navigation()
));

$controller->user_profile();

render('footer');
?>
