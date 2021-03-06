<?php 
//use ajax below with the id to get what we need after the page load, or curl it some more here before the page load

if (isset($_GET['restaurantid'])) {
  $restaurantId = $_GET['restaurantid'];
  $data = array(
    "restaurantid" => $restaurantId
  );  
}
else{
  $data = array(
    "restaurantname" => $_GET['restaurantname'],
    "latitude" => $_GET['lat'],
    "longitude" => $_GET['lng']
  );
  $url_send ="https://mfbackend.appspot.com/json/getrestaurantid";
  $str_data = http_build_query($data) . "\n";
  $url_send = $url_send . "?" . $str_data;

  function sendPostData($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  $data =  json_decode( sendPostData($url_send), true);
  $restaurantName = $data['restaurants'][0]['name'];
  $restaurantId = $data['restaurants'][0]['restaurantid'];
}

?>


<?php include("header.php"); ?>

<div class="container">
  <h1 id="restaurantName"></h1>

  <div class="new-panel">
    <a id="newDish" >Vote on a new dish</a>
      <hr>
      <h2>Dishes</h2>
      <div id="itemsList"></div>
      <div id="fakeEntry"></div>
  </div> 

</div>

<script>
 $(document).ready( function(){
   
   var restaurantId = <?= $restaurantId; ?>;

   dataToSend = {
     userid: '<?= $userId; ?>',
     authtoken: '<?= $authToken;  ?>', 
     restaurantid: restaurantId
   };

   $.ajax({
     url: "http://mfbackend.appspot.com/json/getmenu",
     dataType: "json",
     data: dataToSend,
     type: "GET",
     success: function(data){
       console.log(data);

       $("#restaurantName").html( 'Menu for ' + data.restaurantname );
       $("#newDish").attr("href", "/votenew?restaurantid="+restaurantId+"&restaurantname="+encodeURIComponent(data.restaurantname).replace(/[!'()*]/g, escape));

       if (data.items.length > 0){
	 for (var key in data.items){
	   html = "";
	   console.log(data.items[key]);
	   html = "<a href='/vote?restaurantid=";
	   html += "" + restaurantId;
	   html += "&itemid=";
	   html += data.items[key].itemid;
	   html += "&itemname=";
	   html += encodeURIComponent(data.items[key].name).replace(/[!'()*]/g, escape);
	   html += "&restaurantname=";
	   html += encodeURIComponent(data.restaurantname).replace(/[!'()*]/g, escape);
	   html += "'>";
	   html += data.items[key].name + ": " + data.items[key].rating;
	   html += "%";
	   html += "</a><br/>";
	   $("#fakeEntry").before(html);
	 }
       }
       
       else{
	 $("#fakeEntry").before("<p>No dishes here so far</p>");
       }
     }
   });


 });
</script>
<?php include("footer.php"); ?>
