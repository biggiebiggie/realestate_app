<?php

session_start();
if( $_SESSION ){
  echo '{"status":1,"message":"success"}';
  exit;
}


$sCorrectEmail = 'a@a.com';
$sCorrectPassword = 'password';

if( empty($_POST['email']) ){ sendError( 'missing email', __LINE__ ); }
if( empty($_POST['password']) ){ sendError( 'missing password' , __LINE__ ); }

if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){ sendError( 'invalid email', __LINE__ ); }
if( strlen($_POST['password']) < 8 ){ sendError( 'password is too short', __LINE__ ); }
if( strlen($_POST['password']) > 100 ){ sendError( 'password is too long', __LINE__ ); }


if( $_POST['email'] != $sCorrectEmail ||
    $_POST['password'] != $sCorrectPassword ){ 
  sendError( 'incorrect credentials', __LINE__ ); }


$_SESSION['sUserId'] = 'x';

echo '{"status":1,"message":"success"}';







// **************************************************
function sendError( $sMessage , $iLineNumber  ){
  echo '{"status":0, "message":"'.$sMessage.'", "line":'.$iLineNumber.'}';
  exit; 
}



