
      <section id="main">

            <div id="sign-up">
              <h2 class="form-title">Create an Account and Join Us Today</h2>

              <p>
                  <?php if($error_message != "") echo $error_message ?>
              </p>

              <form action="signup" id="registration-form" method="post">
                <div class="form-field">
                  <label for="username">
                    Username:
                  </label>
                  <input type="text" id="registration-username"
                   name="username" required autocomplete="off" />
                </div>

                <div class="form-field">
                  <label for="registration-email">
                    Email:
                  </label>
                  <input type="email" id="registration-email"
                  name="email" required autocomplete="off" />
                </div>

                <div class="form-field">
                  <label for="registration-password">
                    Password:
                  </label>
                  <input type="password" id="registration-password"
                   name="password" required autocomplete="off" />
                </div>

                <div class="form-field">
                  <label for="registration-password-confirm">
                    Confirm Password:
                  </label>
                  <input type="password" id="registration-password-confirm"
                  name ="confirm_password" required autocomplete="off" />
                </div>

                <div class="field-wrap">
                    <select name="country" required autocomplete="off">
                         <?php
                              foreach ($countries as $country) {
                                  echo '<option value="' . $country . '">' . $country . '</option>';
                              }
                          ?>
                    </select>
                </div>

                <div class="form-field">
                    <button type="submit" class="button-button-submit
                     margin-center"/>Get Started</button>
                    <p class="terms-of-service margin-center">
                        *By signing up you agree to our Terms of Service and Privacy Policy
                    </p>
                </div>


              </form>
              <!-- end sign-up form -->

            </div>
            <!-- end sign-up -->

      </section>
      <!-- end main section -->
