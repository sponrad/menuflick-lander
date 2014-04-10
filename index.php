<?php include("header.php"); ?>
<div class="container">
  <div class="row">

    <div class="col-md-4 phone-contain">
      <div class="iphone">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="img/screen-1.png">
            </div>

            <div class="item">
              <img src="img/screen-2.png">
            </div>

            <div class="item">
              <img src="img/screen-3.png">
            </div>

            <div class="item">
              <img src="img/screen-4.png">
            </div>

            <div class="item">
              <img src="img/screen-5.png">
            </div>

            <div class="item">
              <img src="img/screen-6.png">
            </div>

          </div>

        </div>
      </div>
    </div><!-- /end md-col-3 -->

    <div class="col-md-8">
      <img src="img/logo.png" class="logo">
      <h1 class="desktop-headline">See & Vote for the best Restaurant Dishes, Anywhere.</h1>

      <a href="#"><img src="img/app-store-logo.png" class="app-store"></img></a>	<br>
      <br>
      Menuflick is currently in alpha phase, try it out by signing up below.
      <br><br>
      <a href="#"><img src="img/app-store-logo.png" class="app-store-mobile"></img></a>

    </div><!-- /end .md-col-9 -->

    <div class="col-md-8">
      <form id="signupform" role="form">
	<div class="form-group">
	  <label for="email">Email Address</label>
	  <input class="form-control" type="text" name="email" placeholder="Email Address" />
	</div>
	<div class="form-group">
	  <label for="username">Username</label>
	  <input class="form-control" type="text" name="username" placeholder="Username" />
	</div>
	<div class="form-group">
	  <label for="password">Password</label>
	  <input class="form-control" type="password" name="password" placeholder="Password" />
	</div>
	<div class="form-group">
	  <label for="passwordtwo">Password Again</label>
	  <input class="form-control" type="password" name="passwordtwo" placeholder="Repeat Password"/>
	</div>
	<div class="form-group">
	  <input class="form-control" name="signupbutton" id="signupbutton" type="submit" value="Signup" />
	</div>
      </form>
    </div><!-- /end .md-col-9 -->

  </div><!-- /end .row -->
</div><!-- /end .container -->
<a class="down-arrow" href="#step-1"></a>
</div>

<section id="step-1">

</section>

<section id="step-2">
  <div class="container">
    <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <div><img src="img/screen-1.png"></div>
        <div><img src="img/screen-2.png"></div>
        <div><img src="img/screen-3.png"></div>
        <div><img src="img/screen-4.png"></div>
        <div><img src="img/screen-5.png"></div>
        <div><img src="img/screen-6.png"></div>
      </div>
    </div>
  </div>
</section>

<section id="step-3" class="visible-xs visible-sm">
  <footer class="mobile-footer">
    <div class="container">
      <h2 class="text-center">Subscribe to Our Mailing List:</h2>
      <div id="mc_embed_signup">
        <form action="http://menuflick.us3.list-manage.com/subscribe/post?u=a47d2e32740692f0f327411f4&id=a24988fd76" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <input type="email" class="form-control" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
          <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">
        </form>
      </div>
    </div>
  </footer>
</section>

<script src="js/swipe.js"></script>
<script src="js/script.js"></script>
<script>
 $(document).ready( function(){
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
