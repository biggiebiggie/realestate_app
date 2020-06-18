<?php
if( $_POST){
  if(isset($_POST['btnAgent'])) {
    $sName = $_POST['txtName'];
    $sPassword = $_POST['txtPassword'];
    $jAgent = new stdClass();
    $jAgent->name = $sName;
    $jAgent->password = $sPassword;
    $jAgent->properties = new stdClass();
    $sAgentUniqueId = uniqid();
    $sjData = file_get_contents('data.json');
    $jData = json_decode( $sjData );
    $jData->agents->$sAgentUniqueId = $jAgent;
    $sjData = json_encode( $jData, JSON_PRETTY_PRINT );
    file_put_contents( 'data.json', $sjData );
    session_start();
    $_SESSION['$jAgent'] = $jAgent;
    print_r($_SESSION['$jAgent']);
    echo '<a href="logout.php">LOGOUT</a>';
  } else {
    $sName = $_POST['txtName'];
    $sPassword = $_POST['txtPassword'];
    $jUser = new stdClass();
    $jUser->name = $sName;
    $jUser->password = $sPassword;
    $sUserUniqueId = uniqid();
    $sjData = file_get_contents('data.json');
    $jData = json_decode( $sjData );
    $jData->users->$sUserUniqueId = $jUser;
    $sjData = json_encode( $jData, JSON_PRETTY_PRINT );
    file_put_contents( 'data.json', $sjData );
    $_SESSION['$jUser'] = $jUser;
    print_r($_SESSION['$jUser']);
    echo '<a href="logout.php">LOGOUT</a>';
  }
}
?>

<form method="POST">
  <input name="txtName" type="text" placeholder="Sur name">
  <input name="txtPassword" type="text" placeholder="Password">
  <div>Are you an agent?
  <input name="btnAgent" type="checkbox"></div>
  <button>SIGNUP</button>
</form>

