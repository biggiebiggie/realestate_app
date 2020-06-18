<?php

// TODO: Validate the price
if( empty( $_POST['price'] ) ){ echo 'error '.__LINE__; exit; }
if( !ctype_digit( $_POST['price'] ) ){ echo 'error '.__LINE__; exit;}
$sPrice = intVal( $_POST['price'] );
if( $sPrice < 1 ){ echo 'error '.__LINE__; exit; }
if( $sPrice > 999999999999 ){ echo 'error '.__LINE__; exit; }


// TODO: Validate the address
$sAddress = $_POST['address'];

$jProperty = new stdClass();
$jProperty->price = $sPrice;
$jProperty->address = $sAddress;
$jProperty->uploadedDate = time();
$jProperty->size = intVal( $_POST['size'] );
$jProperty->images = [];



$iNumberOfImages = count( $_FILES['images']['name']);
for( $i = 0; $i < $iNumberOfImages ; $i++ ){
  $sImageName = $_FILES['images']['name'][$i];
  // echo $sImageName;
  $iImageSize = $_FILES['images']['size'][$i];
  // echo $iImageSize;
  // array_push( $jProperty->images , $sImageName );
  $jProperty->images[$i] = $sImageName;
}



$sProperty = json_encode( $jProperty, JSON_PRETTY_PRINT );
file_put_contents( 'property.json', $sProperty );


