<?php

function log() {

  $logurl = "https://logs-01.loggly.com/inputs/" . getenv("loggly-token") . "/tag/trellotest/";

  $ch = curl_init($logurl);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input');

  $atresult = curl_exec($ch);

  if(curl_errno($ch)) {
    echo "Failed to log! Curl error: " . curl_error($ch);
  }
  curl_close ($ch);
}

log();
