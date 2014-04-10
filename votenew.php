<?php 
//vote page is flexible, needs ids and vote info

$restaurantId = $_GET['restaurantid'];

if (isset($_GET['restaurantname'])){
  $restaurantName = $_GET['restaurantname'];
}

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
      <h1>Add Item Details and Vote</h1>

      <form id="addItemForm">
	<input type="hidden" name="restaurantid" value=<?= $restaurantId; ?> />
	<input type="hidden" name="price" value=0 />
	<input type="hidden" name="description" value=0 />
	<input type="hidden" name="authtoken" value=<?= $authToken; ?> />
	<input type="hidden" name="userid" value=<?= $userId; ?> />
	
	<h2><?= $restaurantName; ?></h2>
	<br>

	<div class="form-group>
	  <label for="name">Dish Name</label>
	  <input type="text" id="name" name="name" class="form-control" placeholder="Enter name of dish" />
	</div>

	<br>
	<input type="submit" id="addItemButton" value="Add Item" />

      </form>
    </div>
  </div>
</div>

<script>

 $(document).ready( function(){

   restaurantId = "<?=$restaurantId ?>";
   restaurantName = "<?=$restaurantName ?>";

   $("#addItemButton").click( function(e){
     e.preventDefault();
     dataToSend = $("#addItemForm").serialize();
     $.ajax({
       url: "http://mfbackend.appspot.com/json/createitem?"+dataToSend,
       dataType: "json",
       type: "GET",
       success: function(data){
	 //do something
	 if (data != ""){
	   var link="";
	   link += "/vote?restaurantid=";
	   link += "" + restaurantId;
	   link += "&itemid=";
	   link += "" + data;
	   link += "&itemname=";
	   link += "" + $("#name").val();
	   link += "&restaurantname=";
	   link += "" + restaurantName;

	   window.location.href = link;
	 }
       }
     });
   });



 });

</script>

<?php include("footer.php"); ?>
