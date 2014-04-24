<?php 
//vote page is flexible, needs ids and vote info

$restaurantId = $_GET['restaurantid'];
if (isset($_GET['itemid'])){
  $itemId = $_GET['itemid'];
}
else{
  $itemId = NULL;
}
if (isset($_GET['itemname'])){
  $itemName = $_GET['itemname'];
}
else{
  $itemName = NULL;
}
if (isset($_GET['restaurantname'])){
  $restaurantName = $_GET['restaurantname'];
}
else{
  $restaurantName = NULL;
}

?>
<?php include("header.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 phone-contain">
      <h1>Vote<?= " on ".$itemName; ?></h1>

      <form id="voteForm">
	<input type="hidden" name="restaurantid" value=<?= $restaurantId; ?> />
	<input type="hidden" name="itemid" value=<?= $itemId; ?> />
	<input type="hidden" name="authtoken" value=<?= $authToken; ?> />
	<input type="hidden" name="userid" value=<?= $userId; ?> />
	<div class="radio-inline">
	  <label>
	    <input type="radio" name="rating" id="rating1" value="100" >
	    Vote Up
	  </label>
	</div>
	<div class="radio-inline">
	  <label>
	    <input type="radio" name="rating" id="rating2" value="50" checked>
	    Meh
	  </label>
	</div>
	<div class="radio-inline">
	  <label>
	    <input type="radio" name="rating" id="rating3" value="0" >
	    Vote Down
	  </label>
	</div>
	<div id="promptDiv" style="font-size: 22px;"></div>
	<!-- 	<textarea placeholder="Write something if you must" name="description" id="description"></textarea> 
	 -->
	<br>
	<input type="submit" id="voteButton" value="Vote" />
      </form>

      <div id="reviewDiv">
	<h2>Reviews of this Item:</h2><br><br>
	<div id="fakeReview"></div>
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
     var html = "<div class='reviewItem'>";
     console.log(data);
     html += convertRating(data.rating) + " ";
     html += "<a class='profilelink' href='/profile?profileid="+data.userid+"'>" + data.username + "</a><br>";
     
     html += data.prompt
		 .replace("{{input}}", "<span style='display: inline; color:red;'>"+data.input+"</span>")
		 .replace("{{restaurant}}", "<a style='display: inline;' href='/items?restaurantid="+ data.restaurantid +"'>"+data.restaurant+"</a>")
		 .replace("{{dish}}", "<a style='display: inline;' href='/vote?restaurantid="+data.restaurantid+"&itemid="+data.itemid+"&restaurantname="+data.restaurant+"&itemname="+data.item+"'>"+data.item+"</a>")
		 .replace("{{input2}}", "<span type='text' name='input2' style='display: inline; color: red;'>"+data.input2+"</span>");

     html += "</div><br>";

     return html;
   }

   function parseVotePrompt(data){
     //takes the prompt and returns an html string
     var html = "" + data.prompt;
     html = html.replace("{{input}}", "<input type='text' name='input' style='display: inline;'>");
     html = html.replace("{{input2}}", "<input type='text' name='input2' style='display: inline;'>");
     html = html.replace("{{restaurant}}", "<span style='color: red;'><?=$restaurantName?></span>");
     html = html.replace("{{dish}}", "<span style='color: red;'><?=$itemName?></span>");
     html = html + "<input type='hidden' name='promptid' value='"+data.promptid+"'/>";

     return html;
   }

   $.ajax({
     url: "http://mfbackend.appspot.com/json/getprompt",
     dataType: "json",
     type: "GET",
     success: function(data){
       if (data.response == 1){
	 //console.log(data);
	 $("#promptDiv").html( parseVotePrompt(data) );
       }
     }
   });

   dataToSend = {
     itemid: '<?= $itemId; ?>'
   };

      $.ajax({
     url: "http://mfbackend.appspot.com/json/getitemreviews",
     dataType: "json",
     data: dataToSend,
     type: "GET",
     success: function(data){
       console.log(data);
       if (data.response == 1){
	 for (var key in data.feed_items){
	   var html = parsePrompt(data.feed_items[key]);
	   $("#fakeReview").after( html );
	 }	
       }
     }
   });

   $("#voteButton").click( function(e){
     e.preventDefault();
     dataToSend = $("#voteForm").serialize();
     $.ajax({
       url: "http://mfbackend.appspot.com/json/reviewitem",
       dataType: "json",
       data: dataToSend,
       type: "POST",
       success: function(data){
	 //do something
	 if (data.response == 1){
	   console.log("vote success");
	   alert("Thanks for that swell vote, rating is now: " + data.rating);
	 }
       }
     });
   });
});

</script>

<?php include("footer.php"); ?>
