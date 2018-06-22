<section id="main">

    <h2 class="form-title">Change Password</h2>

    <p style="text-align:center;color:red">
        <?php if($error_message != "") echo $error_message ?>
    </p>

    <form action="change_password" class="form registration-form" method="post">
        <fieldset>
            <label for="old-password">Old Password:</label>
            <input type="password" id="old-password"
             name="old_password" required autocomplete="off" />

            <label for="new-password">New Password:</label>
            <input type="password" id="new-password"
             name="new_password" required autocomplete="off" />

            <label for="new-password-confirm">Confirm Password:</label>
            <input type="password" id="new-password-confirm"
            name ="new_confirm_password" required autocomplete="off" />

          <input type="submit" name="submit" value="Apply">
        </fieldset>

    </form>
    <!-- end sign-up form -->

</section>
<!-- end main section -->
