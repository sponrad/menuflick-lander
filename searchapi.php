<?php

$data = array(
  //"key" => "AIzaSyD82p3cZfbO7xQthU1aE9Nu3L89SaEhWbI", //website
  "key" => "AIzaSyBfqZNaQ6d9AtdZXPI5vkHBLk-pcq1hqOg", //server ip
  //"key" => "AIzaSyCkBh8u9kR_yuyyxzeMzZDeHEyQF1PmlwU",  //personal
  "location" => $_GET['location'],
  "sensor" => "false",
  "types" => "cafe|restaurant|bar|bakery",
  "rankby" => "distance"
);

$url_send ="https://maps.googleapis.com/maps/api/place/nearbysearch/json";
$str_data = http_build_query($data) . "\n";
//$str_data = http_build_query($data, '', '&amp;');
$url_send = $url_send . "?" . $str_data;

function sendPostData($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

//echo "ok";
echo $url_send;
echo " " . sendPostData($url_send);
?>
