<?php
session_start();
$_SESSION['sAgentId'] = 'A2'; // This should come from the login
if( !$_SESSION ){ sendError('cannot delete agent', __LINE__); }

$sAgentId = $_SESSION['sAgentId']; // A1

$sjData = file_get_contents(__DIR__.'/data.json'); // Database
$jData = json_decode( $sjData );
unset( $jData->agents->$sAgentId );
// echo json_encode( $jData , JSON_PRETTY_PRINT );
$sjData = json_encode( $jData , JSON_PRETTY_PRINT  );
file_put_contents( __DIR__.'/data.json', $sjData );
session_destroy(); // MUST HAVE THIS ON THIS END POINT

echo '{"status":1, "message":"agent deleted", "line":'.__LINE__.'}';



// **************************************************
function sendError( $sMessage , $iLineNumber  ){
  echo '{"status":0, "message":"'.$sMessage.'", "line":'.$iLineNumber.'}';
  exit; 
}



