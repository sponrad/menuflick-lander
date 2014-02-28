<?php include("header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-md-4 phone-contain">
      <h1>Nearby Restaurants</h1>
      <div id="restaurantsList"></div>
    </div>
  </div>
</div>

<script>
$(document).ready( function(){

var lat=0;
var lng=0;

   //get location
   if (navigator.geolocation) {
     var timeoutVal = 10 * 1000 * 1000;
     navigator.geolocation.getCurrentPosition(
       displayPosition, 
       displayError,
       { enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
     );
   }
   console.log("one");
   function displayPosition(position) {
     //alert("Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude);
     lat = position.coords.latitude;
     lng = position.coords.longitude;

     //hit google search api
     dataToSend = {
       location: lat+","+lng, 
//       key: "AIzaSyD82p3cZfbO7xQthU1aE9Nu3L89SaEhWbI", 
//       sensor: "false", 
//       types: "cafe|restaurant|bar|bakery",
//       rankby: "distance",
//       callback: "mysonpfunction"
     };

     console.log("before_ajax");

     $.ajax({
       url: '/searchapi.php',
       data: dataToSend, 
       type: 'GET',
       async: 'true',       
       success: function(data){
	 console.log("before data spit");
	 console.log(data);
       }
     });
   }

   function displayError(error) {
     var errors = { 
       1: 'Permission denied',
       2: 'Position unavailable',
       3: 'Request timeout'
     };
     alert("Error: " + errors[error.code]);
   }
  
 });
</script>
<?php include("footer.php"); ?>
