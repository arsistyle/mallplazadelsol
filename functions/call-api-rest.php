<?php
  function CallAPI($url, $echo = false){
    $contents = file_get_contents($url);
    $contents = utf8_encode($contents);
    $results = json_decode($contents);
    if ($echo) echo $results;
    return $results;
  }
?>