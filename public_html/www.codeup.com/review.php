<?php

require_once("../codeup_res/helpers.php");
require_once("../codeup_res/choose_controller.php");

render('header', array(
    'title' => "User suggestions",
    'css' => array('css/style.css', 'css/login.css'),
    'navigation' => $controller->header_navigation()
));

// $controller->fetch_bug_reports();
?>

<section id="main">
    <div class="submissions-container">
        <form class="form submission">

            <h4 class="title">BugReport#1 </h4>
            <h5 class="author"> By: <a href="#" class="profile-link">DrLaki</a></h5>
            <p class="text"> Lorem ipsum dolor sit amet, consectetur adipisicing
            elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
            dolor in reprehenderit in voluptate velit esse cillum dolore eu
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est
            laborum.
            </p>
            <div class="control-buttons">
                <button type="submit" name="decline">
                    Decline
                </button>
                <button type="submit" name="pass">
                    Pass
                </button>
                <button type="submit" name="accept">
                    Accept
                </button>
            </div>
        </form>
        <!-- one submission end -->



        </div>
        <!-- all submissions end -->
</section>


<?php
render('footer');
?>
