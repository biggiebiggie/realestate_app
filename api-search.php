<?php
// header( 'Access-Control-Allow-Origin:*' );
if( !isset( $_GET['search'] ) ){
  echo '[]';
  exit;
}

$sSearchFor = $_GET['search']; // The user's input 2400
$zipCodes = ['2400', '2700', '3500', '3730']; // Database
$matches = [];

foreach( $zipCodes as $zipCode ){
  if( strpos( $zipCode , $sSearchFor  ) !==  false ){ // ! = =
    array_push( $matches , $zipCode );
  }
}

echo json_encode($matches);








// = =  1 is the same as "1" 
// = = = 1 is not the same as "1"
// Checking the data type

/*
$fruits = array("apple","orange","papaya","grape","apple juice", "applecurd");
$content = "ppl";
$content = str_split($content);
$count = count($content);

Foreach($fruits as $fruit){
    $arr_fruit = str_split($fruit);
    // sort $content to match order of $arr_fruit
    $SortCont = array_merge(array_intersect($arr_fruit, $content), array_diff($content, $arr_fruit));
    // if the first n characters match call it a match
    If(array_slice($SortCont, 0, $count) == array_slice($arr_fruit, 0, $count)){
        Echo "match: " . $fruit ."\n";
    }
}
*/






/*
if( in_array( $sSearchFor , $aZipCodes ) ){
  echo 'Match';
}else{
  echo 'Not found';
}
*/











