<?php include("login-header.php"); ?>
<div class="container">
  <h1>Sign Up</h1>
  <form role="form" id="signupform">

  <div class="form-group sign-up-div">
    <label for="email">Email Address</label>
    <input class="form-control" type="text" name="email" placeholder="Email Address" autocapitalize="off" />
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" type="text" name="username" placeholder="Username" autocapitalize="off" />
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" placeholder="Password" autocapitalize="off" />
  </div>

  <div class="form-group">
    <label for="passwordtwo">Password Again</label>
    <input class="form-control" type="password" name="passwordtwo" placeholder="Repeat Password" autocapitalize="off"/>
  </div>

  <div class="form-group">
    <input class="form-control sign-up-button" name="signupbutton" id="signupbutton" type="submit" value="Sign Up" />
  </div>

  </form>
</div><!-- /end .container -->
<?php include("footer.php"); ?>
