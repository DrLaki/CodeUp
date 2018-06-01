
      <section id="main">
              <h2 class="form-title">Welcome Back!</h2>

              <p style="text-align:right">
                  <?php if($error_message != "") echo $error_message ?>
              </p>

              <form action="login" method="post">

               <div class="form-field">
                <label>
                  Username
                </label>
                <input name="username" type="username" required autocomplete="off"/>
               </div>

              <div class="form-field">
                <label>
                  Password
                </label>
                <input name="password" type="password" required autocomplete="off"/>
                <p class="forgot-password block"><a href="#">Forgot Password?</a></p>
              </div>


              <div class="button button-submit margin-center">
                  <button type="button" class="block minw-100px margin-center"
                  name="form-button">Submit</button>
              </div>

              </form>
            <!-- end log-in form -->
      </section>
      <!-- end main section -->
