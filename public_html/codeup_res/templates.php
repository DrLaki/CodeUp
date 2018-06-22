<?php

function template_ErrorMsg($error_msg){
        return
        "<p class='error-msg'>" .
            $error_msg .
        "</p>";
}

function templatePage_ErrorMsg($error_msg){
    return
     "<section id='main'>"  .
        template_ErrorMsg($error_msg) .
    "</section>";
}

function template_SuccessMsg($success_msg){
        return
        "<p class='success-msg'>" .
            $success_msg .
        "</p>";
}

function templatePage_SuccessMsg($success_msg){
    return
     "<section id='main'>"  .
        template_SuccessMsg($success_msg) .
    "</section>";
}

function template_bugReport($title, $user_info, $body, $bug_id){
    return template_userSubmission($title, $user_info, $body, $bug_id, "bug-report");
}


function template_featureRequest($title, $user_info, $body, $request_id){
    return template_userSubmission($title, $user_info, $body, $request_id, "feature-request");
}

function template_userSubmission($title, $user_info, $body, $submission_id, $submission_type ){
        $username = $user_info['username'];
        $user_id = $user_info['user_id'];
        $link_to_profile = "profile?id=" . $user_id;
        return "
        <form class='form submission' method='post' action='suggestions'>
            <h4 class='title'> $title </h4>
            <h5 class='author'> By: <a href=$link_to_profile class='profile-link'>$username</a></h5>
            <p class='text'>
                $body
            </p>
            <div class='control-buttons'>
                <button type='submit' name='decline'>
                    Decline
                </button>
                <button type='submit' name='accept'>
                    Accept
                </button>
            </div>
            <input type='hidden' name='title' value='" . $title . "'/>
            <input type='hidden' name='body' value='" . $body . "'/>
            <input type='hidden' name='submission-type' value='" . $submission_type .  "' />
            <input type='hidden' name='submission-id' value='" . $submission_id . "' />
        </form> "
        ;
}

?>
