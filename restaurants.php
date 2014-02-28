<?php include("header.php"); ?>
<div class="container">
  <div class="row">
    <div class="col-md-4 phone-contain">
      <h1>Nearby Restaurants</h1>
      <div id="restaurantsList">
	<div id="fakeEntry"></div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready( function(){

   var lat=0;
   var lng=0;

   var result= 0;

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
     };

     console.log("before_ajax");

     function restaurantEntry(data){
       //given restaurant data return good html div
       var html = "<div>";
       html = html + data.name;
       html = html + "</div>";
       
       return html;
     }

     $.ajax({
       url: '/searchapi.php',
       dataType: 'json',
       data: dataToSend, 
       type: 'GET',
       success: function(data){
	 console.log("before data spit");
	 console.log(data.results);
	 
	 for (var key in data.results){
	   $("#fakeEntry").before( restaurantEntry( data.results[key] ) );
	 }	
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
