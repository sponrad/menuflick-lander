<?php include("login-header.php"); ?>
<?php 
if ( isset($_SESSION['authToken']) && isset($_SESSION['userId']) ) { 
  header( 'Location: http://www.menuflick.com/feed' ) ;
}
?>

<div class="container text-center">

  <img src="img/logo.jpg" class="img-responsive logo">

  <form id="loginForm" action="/login" method="post">
    <input type="text" name="username" placeholder="username" autocapitalize="off" />
    <input type="password" name="password" placeholder="password" autocapitalize="off" />
    <input type="submit" id="loginButton" value="Sign In" />
  </form>

</div><!-- /end .container -->

<!-- <div class="container text-center">
  <style type = "text/css" scoped>
   div{
     font-size: 20px;
   }
   .box{
     background: white;
     border: 3px solid black; 
     padding: 5px;
     display: inline-block;
   }
   #dish{
     width: 200px;
   }
   #restaurant{
     width: 200px;
   }
   #creative1{
     width: 200px;
   }
   #creative2{
     width: 200px;
   }

  </style>

  <div>
    <span id="dish" class="box">The What you ate</span> at <span id="restaurant" class="box">Where you ate</span> was completely <span id="creative1" class="box">creative</span> but also <span id="creative2" class="box">creative</span>
  </div>
</div> -->

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

   //animate!
   restaurants = [
     "Bob's Burgers",
     "Restaurant",
     "Honker Burger",
     "Moe's Tavern",
     "Good Burger",
     "Roger's Spaghetti Plant",
   ];
   dishes = [
     "Burger",
     "Snodgrass",
     "Fish dander",
   ];
   creative = [
     "dander-covered",
     "crappy",
     "delightsome",
     "sloppy",
     "good",
     "terrible",
     "fishy",
     "dancable",
     "trendy",
     "old",
     "hairy",
     "smelly",
     "mouth-watering",
   ];

   function dish() {
     dish = dishes[Math.floor(Math.random() * dishes.length)];
     $("#dish").html(dish);
   }
   (function dishloop() {
     var rand = Math.round(Math.random() * (3000 - 500)) + 500;
     setTimeout(function() {
       dish();
       dishloop();  
     }, rand);
   }());

   function restaurant() {
     restaurant = restaurants[Math.floor(Math.random() * restaurants.length)];
     $("#restaurant").html(restaurant);
   }
   (function rloop() {
     var rand = Math.round(Math.random() * (3000 - 500)) + 500;
     setTimeout(function() {
       restaurant();
       rloop();  
     }, rand);
   }());

   function creativeone() {
     creative1 = creative[Math.floor(Math.random() * creative.length)];
     $("#creative1").html(creative1);
   }
   (function coloop() {
     var rand = Math.round(Math.random() * (3000 - 500)) + 500;
     setTimeout(function() {
       creativeone();
       coloop();  
     }, rand);
   }());

   function creativetwo() {
     creative2 = creative[Math.floor(Math.random() * creative.length)];
     $("#creative2").html(creative2);
   }
   (function ctloop() {
     var rand = Math.round(Math.random() * (3000 - 500)) + 500;
     setTimeout(function() {
       creativetwo();
       ctloop();  
     }, rand);
   }());


 });
</script>

<?php include("footer.php"); ?>
