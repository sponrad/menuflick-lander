<footer>
  <div class="container">
    <div class="col-md-3">
      
    </div>
    <div class="col-md-9">
      <div class="offset-left">
	<h2>Subscribe to Our Mailing List:</h2>
	
	<div id="mc_embed_signup">
	  <form action="http://menuflick.us3.list-manage.com/subscribe/post?u=a47d2e32740692f0f327411f4&amp;id=a24988fd76" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	    <input type="email" class="form-control" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
	    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">
	  </form>
	  
	</div>
      </div>
    </div><!-- /end .col-md5 -->
    
    <!--End mc_embed_signup-->
    
    
  </div><!-- /end .container -->
</footer>

<script>
 
 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-39574765-1']);
 _gaq.push(['_trackPageview']);
 
 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();
</script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<script>
 $(document).ready( function(){
   $("#loginLink").click( function(e){     
     e.preventDefault();
     $("#loginDiv").toggle();
   });
   
   $("#loginButton").click( function(e){
     e.preventDefault();
     formdata = $("#loginForm").serialize();
     $.post('http://mfbackend.appspot.com/json/login',
	    formdata,
	    function(returndata){
	 if (returndata.response == 1) {
	   console.log("successful login");
	   //redirect to /login?var1=var1&var2=var2;
	   window.location.href = ("login?authToken=" + returndata.auth_token +"&userId=" + returndata.user_dict.user_id );
	 }
	 else {
	   console.log("unsuccessful login");
	 }
       }, "json");
   });
 });
</script>

</body>
</html>
