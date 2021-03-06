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
  <h1 id="userName">Profile</h1>
  <div id="profileList">
    <div id="isfollowing"></div>

      <ul class="list-inline" style="font-size: 14px; color: #aaa;">
        <li>Following: <span id="following"></span></li>
        <li>Followers: <span id="followers"></span></li>
        <li>Reviews: <span id="reviews"></span></li>
      </ul>

      <div id="reviewDiv">
        <h2>Your Reviews</h2>
        <hr>
        <div id="fakeReview"></div>
      </div>

  </div><!-- /end .panel -->
</div><!-- /end .container -->

<script>
 $(document).ready( function(){
   
   var profileId = <?= $profileId; ?>;

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
