<?php

 require_once("../codeup_res/helpers.php");
 require_once("../codeup_res/choose_controller.php");
 require_once("../codeup_res/templates.php");

 render('header', array(
     'title' => "Privacy Policy",
     'css' => array('css/style.css'),
     'navigation' => $controller->header_navigation()
 ));


 if (isset($_POST['submission-type'])){
     $submission_type = $_POST['submission-type'];


     if ($submission_type == 'bug-report'){
         require_once("../codeup_res/models/user_suggestions_pool.php");
         $bug_id = $_POST['submission-id'];
         (isset($_POST['accept'])) ? UserSuggestionsPool::accept_bug_report($bug_id) :
                                    UserSuggestionsPool::reject_bug_report($bug_id) ;
     }
     else if ($submission_type == 'feature-request'){
         require_once("../codeup_res/models/user_suggestions_pool.php");
         $feature_req_id = $_POST['submission-id'];
         (isset($_POST['accept'])) ? UserSuggestionsPool::accept_feature_req($feature_req_id) :
                                    UserSuggestionsPool::reject_feature_req($feature_req_id) ;
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
?>


<?php
 render('footer');
 ?>
