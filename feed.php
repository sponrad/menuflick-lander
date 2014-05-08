<?php include("header.php"); ?>
<div class="container">
  <h1></h1>
  <div id="feedDiv" style="background: white;">
    <div id="fakeItem">Loading&hellip;</div>
  </div>
</div>

<script>
 $(document).ready( function(){
   var dataToSend = {
     userid: <?= $userId; ?>,
   };

   $.ajax({
     url: 'http://mfbackend.appspot.com/json/getfeed',
     dataType: 'json',
     data: dataToSend, 
     type: 'GET',
     success: function(data){
       console.log(data);
       if (data.response == 1){
	 for (var key in data.feed_items){
	   var html = parsePrompt(data.feed_items[key]);
	   $("#fakeItem").after( html );
	   $("#fakeItem").html("");
	 }	
       }
     }
   });
 });
</script>

<!--
 _______________ 
/ EAT AT DAN’S   \
\_______________/
 \
 \ 
     __             ___
      // )    ___--""    "-.
 \ |,"( /`--""              `. 
  \/ o                        \
  (   _.-.              ,'"    ;  
   |\"   /`. \  ,      /       |
   | \  ' .'`.; |      |       \.______________________________
     _-'.'    | |--..,,,\_    \________------------""""""""""""
    '''"   _-'.'       ___"-   )
          '''"        '''---~""
 -->
<?php include("footer.php"); ?>
