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

?>
<?php include("header.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-md-8 phone-contain">
      <a href="/items?restaurantid=<?= $restaurantId; ?>">Back to Menu</a>      
      <h1>Add Item Details and Vote</h1>

      <form id="voteForm">
	<input type="hidden" name="restaurantid" value=<?= $restaurantId; ?> />
	<input type="hidden" name="authtoken" value=<?= $authToken; ?> />
	<input type="hidden" name="userid" value=<?= $userId; ?> />

	<div class="form-group>
	  <label for="itemname">Dish Name</label>
	  <input type="text" name="itemname" class="form-control" placeholder="Enter name of dish" />
	</div>
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

	<textarea placeholder="Write something if you must" name="description" class="form-control" id="description"></textarea>
	<br>
	<input type="submit" id="voteButton" value="Vote" />
      </form>
    </div>
  </div>
</div>

<script>

 $(document).ready( function(){
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
	   alert("Thanks for the submission and vote, rating is now: " + data.rating);
	 }
       }
     });
   });
 });

</script>

<?php include("footer.php"); ?>
