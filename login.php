<?php 
// just a redirect file
//receive parameters, set session variables, redirect to feed, or back t o
session_start();

echo "hello";

//form, username and password is sent

$data = array(
  "username" => $_POST['username'],
  "password" => $_POST['password']
);

$url_send = "https://mfbackend.appspot.com/json/login";
//$str_data = json_encode($data);

function sendPostData($url, $post){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-type" => "application/json",
    "Content-length" => "" . strlen($post))
	      );
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

//$data = sendPostData( $url_send, $data);

//echo " ".$data;

$data =  json_decode( sendPostData($url_send, $data), true);

echo " ".$data['response'];

if ($data['response'] == 1){
  $_SESSION["authToken"] = $data['auth_token'];
  $_SESSION["userId"] = $data['user_dict']['user_id'];

  header("Location: http://www.menuflick.com/feed");
}
else {
  header("Location: http://www.menuflick.com/");
}

?>

<?php include("header.php"); ?>
<br><br><br>
<form id="loginForm" action="/login" method="post">
  <input type="text" name="username" placeholder="username" />
  <input type="password" name="password" placeholder="password" /></br>
  <input type="submit" id="loginButton" value="Login" />
</form>

<?php include("footer.php"); ?>
