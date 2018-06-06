      <section id="main">

          <h2 class="form-title">Create an Account and Join Us Today</h2>

          <p style="text-align:center">
              <?php if($error_message != "") echo $error_message ?>
          </p>

          <form action="register" class="form registration-form" method="post">
              <legend>Registration Form</legend>
              <fieldset>
                  <label for="username">Username:</label>
                  <input type="text" id="registration-username"
                   name="username" required autocomplete="off" />

                  <label for="registration-email">Email:</label>
                  <input type="email" id="registration-email"
                  name="email" required autocomplete="off" />

                  <label for="registration-password">Password:</label>
                  <input type="password" id="registration-password"
                   name="password" required autocomplete="off" />

                  <label for="registration-password-confirm">Confirm Password:</label>
                  <input type="password" id="registration-password-confirm"
                  name ="confirm_password" required autocomplete="off" />

                  <label for="country">Country:</label>
                  <select name="country" id="country" required autocomplete="off">
                     <?php
                          foreach ($countries as $country) {
                              $is_selected = ($country == "United States" ? "selected" : "");
                              echo '<option value="' . $country . '" ' . $is_selected . '>' . $country . '</option>';
                          }
                      ?>
                  </select>

                <input type="submit" name="signup-button" value="Get Started">
                <p class="terms-of-service">
                    *By signing up you agree to our Terms of Service and Privacy Policy
                </p>
              </fieldset>

          </form>
          <!-- end sign-up form -->

      </section>
      <!-- end main section -->
