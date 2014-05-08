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
      <h1 class="vote-on">Vote<?= " on ".$itemName; ?></h1>

      <div class="new-panel">
        <form id="voteForm">
          <input type="hidden" name="restaurantid" value=<?= $restaurantId; ?> />
          <input type="hidden" name="itemid" value=<?= $itemId; ?> />
          <input type="hidden" name="authtoken" value=<?= $authToken; ?> />
          <input type="hidden" name="userid" value=<?= $userId; ?> />


          <div id="promptDiv" style="font-size: 22px;"></div>

          <div class="btn-group vote-buttons" data-toggle="buttons" style="margin-bottom: 15px;">
            <label class="btn btn-primary first-vote-btn">
              <input type="radio" name="rating" id="rating1" value="100"> <span class="fa fa-smile-o"></span>
            </label>
            <label class="btn btn-primary second-vote-btn">
              <input type="radio" name="rating" id="rating2" value="50"> <span class="fa fa-meh-o"></span>
            </label>
            <label class="btn btn-primary third-vote-btn">
              <input type="radio" name="rating" id="rating3" value="0"> <span class="fa fa-frown-o"></span>
            </label>
          </div>


          <input type="submit" id="voteButton" value="Vote" class="btn btn-primary btn-block" style="font-size: 20px;">
        </form>

        <div id="reviewDiv" style="margin-top: 50px;">
          <h2 style="line-height: 26px;">What other people think of this item:</h2>
          <hr>
          <div id="fakeReview"></div>
        </div>
      </div><!-- /end .new-panel -->

    </div><!-- /end .col-md-12 -->
  </div><!-- /end .row -->
</div><!-- /end .container -->

<script>

$(document).ready( function(){

   $('#promptDiv input[type="text"]').css({'border': '1px solid red;'});

   item = "<?= $itemName; ?>";
   restaurant = "<?= $restaurantName; ?>";
   lat = "<?= $lat; ?>";
   lng = "<?= $lng; ?>";
   console.log(lat);
   console.log(lng);

   $.ajax({
     url: "http://mfbackend.appspot.com/json/getprompt",
     dataType: "json",
     type: "GET",
     success: function(promptdata){
       if (promptdata.response == 1){
	 console.log(promptdata);
	 $("#promptDiv").html(parseVotePrompt(promptdata, item, restaurant));
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
     console.log(restaurant);
     window.location = 'http://menuflick.com/restaurants';
	 }
       }
     });
   });
});

</script>

<?php include("footer.php"); ?>
