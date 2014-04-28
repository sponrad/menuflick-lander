<?php include("header.php"); ?>

  <div class="container text-center">

      <?php 
        if ( isset($_SESSION['authToken']) && isset($_SESSION['userId']) ) { 
        $userId = $_SESSION['userId'];
        $authToken = $_SESSION['authToken']; 
      ?>
      <img src="img/logo.jpg" class="img-responsive logo">

      <form id="loginForm" action="/login" method="post">
        <input type="text" name="username" placeholder="username" />
        <input type="password" name="password" placeholder="password" />
        <input type="submit" id="loginButton" value="Sign In" />
      </form>

      <nav>
        <ul class="list-inline">
          <li><button id="logoutLink" onlcick="location.href='http://www.menuflick.com/logout'">Logout</button></li>
          <li><button id="feedButton" onclick="location.href='http://www.menuflick.com/feed'">Feed</button></li>
          <li><button id="menuButton" onclick="location.href='http://www.menuflick.com/restaurants'">Menu</button></li>
          <li><button id="menuButton" onclick="location.href='http://www.menuflick.com/profile?profileid=<?= $userId; ?>'">Profile</button></li>
        </ul>
      </nav>
      <?php } else { ?>

      <img src="img/logo.jpg" class="img-responsive logo">

      <div id="loginDiv">
        <form id="loginForm" action="/login" method="post">
          <input type="text" name="username" placeholder="username" />
          <input type="password" name="password" placeholder="password" />
          <input type="submit" id="loginButton" value="Sign In" />
        </form>
      </div>

      <?php } ?>



    </div><!-- /end .container -->
<a href="/signup" class="sign-up-cta">Sign Up</a>


<script src="js/swipe.js"></script>
<script src="js/script.js"></script>
<script>
 $(document).ready( function(){
   $.ajax({
     url: "http://mfbackend.appspot.com/json",
     success: function(data){ console.log(data); }
   });
   $("#signupbutton").click( function(e){
     e.preventDefault();
     formdata = $("#signupform").serialize();
     $.post('http://mfbackend.appspot.com/json/signup',
	    formdata,
	    function(returndata){
	 console.log(returndata);
	 if returndata.response == 1 {
	   alert("Successful signup, continue to login");
	 }
	 else {
	   alert("Something went wrong");
	 }
       }, "json");
   });
 });
</script>

<?php include("footer.php"); ?>
