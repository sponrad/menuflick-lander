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
    </div>
  </div>
</div>

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
	 }
	 else {
	   $("#isfollowing").html("<button id='followButton'>Follow</button>");
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
