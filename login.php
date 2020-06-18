<?php
// Check if email matches, then go to profile
if($_POST) {
    // Open the content of the file / Read the file
    $sjUsers = file_get_contents('data.json');
    $jUsers = json_decode($sjUsers);
    print_r($jUsers);
    foreach($jUsers as $jUser) {
        if($_POST['txtEmail'] == $jUser->email && $_POST['txtPassword'] == $jUser->password) {
            session_start();
            $_SESSION['jUser'] = $jUser;
            header('Location: profile.php');
            
        } else {
            echo "Try again";
        }
    } 
}

?>

<form method="POST">
  <input name="txtName" type="text" placeholder="Sur name">
  <input name="txtPassword" type="text" placeholder="Password">
  <button>LOGIN</button>
</form>