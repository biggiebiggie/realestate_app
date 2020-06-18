<?php
// header( 'Access-Control-Allow-Origin:*' );
if( !isset( $_GET['search'] ) ){
  echo '[]';
  exit;
}

$sSearchFor = $_GET['search']; // The user's input 2400
$zipCodes = []; // Database
$matches = [];

require_once('functions.php');
  
$jData = getFileAsJson(__DIR__.'/agent/agents.json');

foreach($jData as $jUser){
    foreach($jUser->properties as $key=>$jProperty) {
        $propZipCode = $jProperty->zipcode;
        array_push($zipCodes, $propZipCode);
    }
}

foreach( $zipCodes as $zipCode ){
  if( strpos( $zipCode , $sSearchFor  ) !==  false ){ // ! = =
    array_push( $matches , $zipCode );
  }
}

echo json_encode($matches);