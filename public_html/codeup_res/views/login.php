<!-- <section id="main"> -->
<section id="main">

  <h2 class="form-title">Welcome Back!</h2>
  <p style="text-align:center;color:red">
      <?php if($error_message != "") echo $error_message ?>
  </p>
  <form action="login" method="post" class="form login-form">
      <legend>Log-In Info</legend>
      <fieldset>
          <input name="username" type="username" required autocomplete="off" placeholder="Username"/>
          <input name="password" type="password" required autocomplete="off" placeholder="Password"/>
          <p class="forgot-password"><a href="#">Forgot Password?</a></p>
          <input type="submit" class="login-button" value="Log-in" />
      </fieldset>
  </form>

</section>
<!-- end main section -->
