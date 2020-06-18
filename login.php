<?php
  // THIS IS BACK END
  session_start();
  if( $_SESSION ){
    header('Location: profile.php');
  }
  
  if( $_POST ) {
    require_once( __DIR__.'/functions.php' );



    (function() {
        // $email = $GLOBALS['email']; // Make the email on top visible in the function
        // $password = $GLOBALS['password'];
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';


        if (empty($email) ) {
            return; // RETURN WORKS IN FUNTIONS
        }

        $jUsers = getFileAsJson('user/users.json');

        foreach( $jUsers as $key=>$jUser ){
          if( $jUser->email == $email && $jUser->password == $password) {
            $_SESSION['$jUser'] = $jUser;
            header('Location: profile.php');
          }
        }

        $jAgents = getFileAsJson('agent/agents.json');

        foreach( $jAgents as $key=>$jAgent ){
          if( $jAgent->email == $email && $jAgent->password == $password) {
            $_SESSION['$jUser'] = $jAgent;
            header('Location: profile.php?id='.$key.'');
          }
        }
       
    })();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/app.css">
  <title>Login</title>
</head>
<body>
  <section id="login-section">
  <form id="frmLogin" method="POST">
    <div>
      <div>Email</div>
      <input name="email" type="text" data-type="email" value="a@a.com"> 

      <div>Password ( 6 to 20 characters )</div>
      <input name="password" type="text" maxlength="20" minlength="6"
      data-type="string" data-min="6" data-max="20" value="123456">

    </div>

    <button id="btnLogin" onclick="return login(this)" data-wait="WAIT ...">LOGIN</button>

  </form>
</section>
  <script src="js/validate.js"></script>

</body>
</html>



