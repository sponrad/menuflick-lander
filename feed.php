<?php include("header.php"); ?>
<?php

?>
<div class="container">
  <div class="row">
    <div class="col-md-4 phone-contain">
      <h1>Feed</h1>
      <!--  <button id="voteButton">Vote</button> --> 
      <button id="menuButton" onclick="location.href='http://www.menuflick.com/restaurants'">Menu</button>
      <div id="feedDiv">
	<div id="fakeItem"></div>
      </div>
    </div>
  </div>
</div>

<script>
 $(document).ready( function(){
   var dataToSend = {
     userid: <?= $userId; ?>,
   };

   $.ajax({
     url: 'http://mfbackend.appspot.com/json/getfeed',
     dataType: 'json',
     data: dataToSend, 
     type: 'GET',
     success: function(data){
       console.log(data);
       if (data.response == 1){
	 for (var key in data.feed_items){
	   var html = "<div class='feedItem'>";
	   html += "<a>"
	   html += data.feed_items[key].item ;
	   html += "</a> from <a href='/items?restaurantid="+ data.feed_items[key].restaurantid +"'>";
	   html += data.feed_items[key].restaurant;	   
	   html += "</a>";
	   if (data.feed_items[key].description == null){
	   }
	   else {
	     html += "<br><b>";
	     html += data.feed_items[key].description;
	     html += "</b>";
	   }
	   html += "</div><br>";
	   $("#fakeItem").after( html );
	 }	
       }
     }
   });
 });
</script>
<?php include("footer.php"); ?>
