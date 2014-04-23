
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
<script src="js/retina.min.js"></script>

<script>
 $(document).ready( function(){
   $("#loginLink").click( function(e){     
     e.preventDefault();
     $("#loginDiv").toggle();
   });

/*   
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
   */
 });
</script>

</body>
</html>
