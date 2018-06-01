
      <section id="main">
          <div class="window-wrapper">

            <div id="sign-up">
              <h2 class="tab-title">Create an Account and Join Us Today</h2>

              <p style="text-align:center">
                  <?php if($error_message != "") echo $error_message ?>
              </p>

              <form action="signup" method="post">
                <div class="field-wrap">
                  <label>
                    Username
                  </label>
                  <input type="text" name="username" required autocomplete="off" />
                </div>

                <div class="field-wrap">
                  <label>
                    Email
                  </label>
                  <input type="email" name="email" required autocomplete="off" />
                </div>

                <div class="field-wrap">
                  <label>
                    Password
                  </label>
                  <input type="password" name="password" required autocomplete="off" />
                </div>

                <div class="field-wrap">
                  <label>
                    Confirm Password
                  </label>
                  <input type="password" name ="confirm_password" required autocomplete="off" />
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

                <div class="button-wrap">
                    <button type="submit" class="submit-button"/>Get Started</button>
                    <p class="terms-of-service">By signing up you agree to our Terms of Service and Privacy Policy</p>
                </div>


              </form>
              <!-- end sign-up form -->

            </div>
            <!-- end sign-up -->

          </div>
      </section>

      <!-- end main section -->
