<?php include("header.php"); ?>
<div class="container">
  <h1>Nearby Menus</h1>
  <div id="restaurantsList">
    <div id="fakeEntry"><span id="loading">Loading&hellip;</span></div>
  </div>
</div>

<script>
$(document).ready( function(){

   var lat=0;
   var lng=0;

   var result= 0;

   function haversine(lat1, lon1, lat2, lon2){
     Number.prototype.toRad = function() {
       return this * Math.PI / 180;
     }

     var R = 6371; // km 
     //has a problem with the .toRad() method below.
     var x1 = lat2-lat1;
     var dLat = x1.toRad();  
     var x2 = lon2-lon1;
     var dLon = x2.toRad();  
     var a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
                      Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 
     Math.sin(dLon/2) * Math.sin(dLon/2);  
     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
     var d = R * c;      

     d = d * 0.621371 * 5280;  //to mi to feet
     unit = "miles";

     if (d < 1000){  //return feet
       d = Math.round(d);
       d = d + " ft.";
     }
     else{ // return miles
       d = (1 / 100 * Math.round(d / 5280*100)).toFixed(1);
       d = d + " mi."
     }
     
     return d;
   }

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

     function restaurantEntry(data){
       //given restaurant data return good html div
       var distance = haversine( lat, lng, data.geometry.location.lat, data.geometry.location.lng);
       var html = "<a href='/items?restaurantname="+encodeURIComponent(data.name).replace(/[!'()*]/g, escape)+"&lat="+data.geometry.location.lat+"&lng="+data.geometry.location.lng+"'>" + data.name + "</a> ";
       var html = html + "<span id='distance'>"+distance+"</span>";
       return html;
     }

     $.ajax({
       url: '/searchapi.php',
       dataType: 'json',
       data: dataToSend, 
       type: 'GET',
       success: function(data){
	 console.log(data);
        $('#loading').hide();
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
