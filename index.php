<?php

date_default_timezone_set("UTC");

function trello_log() {

  $trellologurl = "https://api.trello.com/1/cards/?token=" . getenv("trello-token") .
  	"&key=" . getenv("trello-key") .
  	"&due=null".
  	"&urlSource=null" .
  	"&idList=" . getenv("trello-log") .
  	"&name=" . urlencode(date("Y-m-d g:i:s")) .
  	"&desc=" . urlencode(var_export($_SERVER, true)) . "%10%10" . urlencode(var_export($_POST, true));

  $ch = curl_init($trellologurl);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

  $atresult = curl_exec($ch);

  if(curl_errno($ch)) {
    echo "Failed to create row in airtable! Curl error: " . curl_error($ch);
  }
  curl_close ($ch);
}

trello_log();
