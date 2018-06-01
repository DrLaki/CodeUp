
      <section id="main">
          <div class="window-wrapper">

            <div id="log-in">
              <h2>Welcome Back!</h2>

              <p style="text-align:right">
                  <?php if($error_message != "") echo $error_message ?>
              </p>

              <form action="login" method="post">

               <div class="field-wrap">
                <label>
                  Username
                </label>
                <input name="username" type="username" required autocomplete="off"/>
               </div>

              <div class="field-wrap">
                <label>
                  Password
                </label>
                <input name="password" type="password" required autocomplete="off"/>
              </div>

              <p class="forgot"><a href="#">Forgot Password?</a></p>
              <div class="button-wrap">
                <button class="submit-button"/>Log In</button>
              </div>

              </form>
            </div>
            <!-- end log-in -->

          </div>
      </section>
      <!-- end main section -->
