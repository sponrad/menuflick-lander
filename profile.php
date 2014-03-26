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
      <h1 id="userName"></h1>
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

     }
   });


 });
</script>
<?php include("footer.php"); ?>
