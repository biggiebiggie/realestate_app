<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>SIGNUP</title>
</head>
<body>
<section id="signup-section">
  <form id="frmSignup" method="POST">
  <div>email</div>
      <input name="email" type="text" data-type="email" value="a@a.com"> 

      <div>password ( 6 to 20 characters )</div>
      <input name="password" type="text" maxlength="20" minlength="6"
      data-type="string" data-min="6" data-max="20" value="123456">
    <div>Are you an agent?
    <input name="btnAgent" type="checkbox"></div>
    <button id="btnSignup" onclick="return fvSignup(this)" data-wait="WAIT ...">SIGNUP</button>
  </form> 
</section>

  <script src="js/validate.js"></script>
</body>
</html>


<?php

require_once('functions.php');
if( $_POST){
  if(isset($_POST['btnAgent'])) {
    global $sEmail;
    $sEmail = $_POST['email'];
    $sPassword = $_POST['password'];
    $sAgentUniqueId = uniqid();
    $jAgent = new stdClass();
    $jAgent->id = $sAgentUniqueId;
    $jAgent->email = $sEmail;
    $jAgent->password = $sPassword;
    $jAgent->image = 'images/default.png';
    $jAgent->isAgent = 1;
    $jAgent->properties = new stdClass();
    
    
    $jData = getFileAsJson(__DIR__.'/agent/agents.json');
    $jData->$sAgentUniqueId = $jAgent;
    saveJsonToFile($jData, __DIR__.'/agent/agents.json');
    session_start();
    $_SESSION['$jUser'] = $jAgent;
    require_once('email/api-send-welcome-email.php');
    header('Location: profile.php?id='. $sAgentUniqueId);
  } 
  else {
    $sEmail = $_POST['email'];
    $sPassword = $_POST['password'];
    $jUser = new stdClass();

    $jUser->email = $sEmail;
    $jUser->password = $sPassword;
    $jUser->image = __DIR__.'/images/default.png';
    $jUser->isAgent = 0;
    $sUserUniqueId = uniqid();
    $jUser->id = $sUserUniqueId;
    $jData = getFileAsJson(__DIR__.'/user/users.json');
    $jData->$sUserUniqueId = $jUser;
    saveJsonToFile($jData, 'user/users.json');
    session_start();
    $_SESSION['$jUser'] = $jUser;
    require_once('email/api-send-welcome-email.php');
    header('Location: profile.php?id='. $sUserUniqueId);
  }
}
?>

