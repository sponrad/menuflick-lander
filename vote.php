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
      <a href="/items?restaurantid=<?= $restaurantId; ?>">Back to Menu</a>      
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
    </div>
  </div>
</div>

<script>

$(document).ready( function(){

   function parsePrompt(data){
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
	 $("#promptDiv").html( parsePrompt(data) );
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
