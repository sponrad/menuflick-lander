<?php include("login-header.php"); ?>

  <div class="container text-center">

      <img src="img/logo.jpg" class="img-responsive logo">

      <form id="loginForm" action="/login" method="post">
        <input type="text" name="username" placeholder="username" autocapitalize="off" />
        <input type="password" name="password" placeholder="password" autocapitalize="off" />
        <input type="submit" id="loginButton" value="Sign In" />
      </form>

    </div><!-- /end .container -->
<a href="/signup" class="sign-up-cta">Sign Up</a>


<script src="js/swipe.js"></script>
<script src="js/script.js"></script>
<script>
 $(document).ready( function(){
   //Dear Server,
   // Wake Up !!
   $.ajax({
     url: "http://mfbackend.appspot.com/json",
     success: function(data){ console.log(data) }
   });
 });
</script>

<?php include("footer.php"); ?>
