<?php

function getFileAsJson( $sFileName ){
    $sjData = file_get_contents( $sFileName );
    $jData = json_decode( $sjData );
    return $jData;
  }
  
  
  function saveJsonToFile( $jData , $sFileName ){
    $sData = json_encode( $jData, JSON_PRETTY_PRINT );
    file_put_contents(  $sFileName ,  $sData );
  }