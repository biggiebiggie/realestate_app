<?php
if( empty( $_GET['propertyId'] ) ){ sendError('cannot update property', __LINE__); }
if( empty( $_GET['propertyPrice'] ) ){ sendError('cannot update property', __LINE__); }

session_start();
$_SESSION['sAgentId'] = 'A1'; // This should come from the login
if( !$_SESSION ){ sendError('cannot update property', __LINE__); }

$sAgentId = $_SESSION['sAgentId']; 

// PopertyID
// Starts with a P and continues with numbers
// REGEX
// ctype_digit // 
$sPropertyId = $_GET['propertyId'];
if( $sPropertyId[0] != 'P' ){
  sendError('cannot update property', __LINE__);
}

if( !ctype_digit( $_GET['propertyPrice'] ) ){ sendError('invalid price', __LINE__); }
if( $_GET['propertyPrice'] < 1 ){ sendError('price too low', __LINE__); }
if( $_GET['propertyPrice'] > 5 ){ sendError('price too hight', __LINE__); }

$sjData = file_get_contents(__DIR__.'/data.json'); // Database
$jData = json_decode( $sjData );
// UPDATE PRICE
if( !isset($jData->agents->$sAgentId->properties->$sPropertyId)  ){
  sendError('property not found', __LINE__);
}
$jData->agents->$sAgentId->properties->$sPropertyId->price = intVal($_GET['propertyPrice']);

$sjData = json_encode( $jData , JSON_PRETTY_PRINT  );
file_put_contents( __DIR__.'/data.json', $sjData );

echo '{"status":1, "message":"price updated", "line":'.__LINE__.'}';



// **************************************************
function sendError( $sMessage , $iLineNumber  ){
  echo '{"status":0, "message":"'.$sMessage.'", "line":'.$iLineNumber.'}';
  exit; 
}



