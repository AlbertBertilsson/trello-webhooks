<?php

function loggly_log($data, $tag) {
  if (empty($tag)) $tag = "trellotest";
  
  $logurl = "https://logs-01.loggly.com/inputs/" . getenv("loggly-token") . "/tag/" . $tag . "/";
  $ch = curl_init($logurl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
  $atresult = curl_exec($ch);
  if(curl_errno($ch)) {
    echo "Failed to log! Curl error: " . curl_error($ch);
  }
  curl_close ($ch);
}
