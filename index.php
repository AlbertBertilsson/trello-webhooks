<?php

date_default_timezone_set("UTC");

function trello_log() {

  $server = $_SERVER;
  $server['trello-key'] = "<key>";
  $server['trello-token'] = "<token>";

  $trellologurl = "https://api.trello.com/1/cards/?token=" . getenv("trello-token") .
  	"&key=" . getenv("trello-key") .
  	"&due=null".
  	"&urlSource=null" .
  	"&idList=" . getenv("trello-log") .
  	"&name=" . urlencode(date("Y-m-d g:i:s")) .
  	"&desc=" . urlencode(var_export($server, true)) . "%0a%0a" . urlencode(file_get_contents('php://input'));

  $ch = curl_init($trellologurl);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

  $atresult = curl_exec($ch);

  if(curl_errno($ch)) {
    echo "Failed to create log card! Curl error: " . curl_error($ch);
  }
  curl_close ($ch);
}

trello_log();
