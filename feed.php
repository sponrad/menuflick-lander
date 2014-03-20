<?php include("header.php"); ?>
<?php

?>
<div class="container">
  <div class="row">
    <div class="col-md-4 phone-contain">
      <h1>Feed</h1>
      <div id="feedDiv">
	<div id="fakeItem"></div>
      </div>
    </div>
  </div>
</div>

<script>
 $(document).ready( function(){
   function convertRating(rating){
     switch(rating)
     {
       case 100:
	 return "+"
	 break;
       case 50:
	 return "/"
	 break;
       case 0:
	 return "-"
	 break;
     }
   }

   function parsePrompt(data){
     var html = "<div class='feedItem'>";
     console.log(data);
     html += convertRating(data.rating) + " ";
     html += "<b>" + data.username + "</b><br>";
     
     html += data.prompt
		 .replace("{{input}}", "<span style='display: inline; color:red;'>"+data.input+"</span>")
		 .replace("{{restaurant}}", "<a style='display: inline;' href='/items?restaurantid="+ data.restaurantid +"'>"+data.restaurant+"</a>")
		 .replace("{{dish}}", "<a style='display: inline;'>"+data.item+"</a>")
		 .replace("{{input2}}", "<span type='text' name='input2' style='display: inline;'>"+data.input2+"</span>");

     html += "</div><br>";

     return html;
   }

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
	   var html = parsePrompt(data.feed_items[key]);
	   $("#fakeItem").after( html );
	 }	
       }
     }
   });
 });
</script>
<?php include("footer.php"); ?>
