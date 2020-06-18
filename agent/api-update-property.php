<?php
$sUserId = $_POST['id'];
$spropertyId = $_POST['propertyId'];

$sKeyToUpdate = $_POST['key']; // name email 
$sNewValue = $_POST['value'];
$sjData = file_get_contents( 'agents.json' ); // text from file
$jData = json_decode( $sjData ); // convert text to JSON
// Update the data
$jData->$sUserId->properties->$spropertyId->$sKeyToUpdate = $sNewValue;
$sjData = json_encode( $jData , JSON_PRETTY_PRINT ); // convert JSON to text
file_put_contents( 'agents.json' , $sjData );