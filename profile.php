<?php
//given a user id, display a profile page
if (isset($_GET['profileid'])) {
  $profileId = $_GET['profileid'];
}
else {
  // do nothing? abort
}

?>

<?php include("header.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-md-8 phone-contain">
      <h1 id="userName">Profile</h1>
      <div id="isfollowing"></div>

      <p>Following: <span id="following"></span></p>
      <p>Followers: <span id="followers"></span></p>
      <p>Reviews: <span id="reviews"></span></p>

      <div id="reviewDiv">
	<div id="fakeReview"></div>
      </div>

    </div>
  </div>
</div>

<script>
 $(document).ready( function(){
   
   var profileId = <?= $profileId; ?>;

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
		 .replace("{{dish}}", "<a style='display: inline;'>"+data.item+"</a>")
		 .replace("{{input2}}", "<span type='text' name='input2' style='display: inline; color: red;'>"+data.input2+"</span>");

     html += "</div><br>";

     return html;
   }

   dataToSend = {
     userid: '<?= $userId; ?>',
     authtoken: '<?= $authToken;  ?>', 
     profileid: profileId,
   };

   $.ajax({
     url: "http://mfbackend.appspot.com/json/getprofile",
     dataType: "json",
     data: dataToSend,
     type: "GET",
     success: function(data){
       console.log(data);
       if (data.response == 1){
	 $("#userName").html( data.username );
	 $("#following").html( data.following );
	 $("#followers").html( data.followers );
	 $("#reviews").html( data.reviewcount );
	 if (data.isfollowing == true){
	   $("#isfollowing").html("<button id='unFollowButton'>Unfollow</button>");
	   if (dataToSend.userid == dataToSend.profileid){
	     $("#isfollowing").html("");
	   }
	 }
	 else {
	   $("#isfollowing").html("<button id='followButton'>Follow</button>");
	 }	 

	 for (var key in data.feed_items){
	   var html = parsePrompt(data.feed_items[key]);
	   $("#fakeReview").after( html );
	 }	
       }
     }
   });

   //follow
   $("#isfollowing").on("click", "#followButton", function(e){
     e.preventDefault();
     $.ajax({
       url: "http://mfbackend.appspot.com/json/followuser",
       dataType: "json",
       data: dataToSend,
       type: "GET",
       success: function(data){
	 console.log(data);
	 if (data.response == 1){
	   $("#isfollowing").html("<button id='unFollowButton'>Unfollow</button>");   
	 }}
     });
   });

   //unfollow
   $("#isfollowing").on("click", "#unFollowButton", function(e){
     e.preventDefault();
     $.ajax({
       url: "http://mfbackend.appspot.com/json/unfollowuser",
       dataType: "json",
       data: dataToSend,
       type: "GET",
       success: function(data){
	 console.log(data);
	 if (data.response == 1){
	   $("#isfollowing").html("<button id='followButton'>Follow</button>");   
	 }}
     });
   });


 });
</script>
<?php include("footer.php"); ?>
