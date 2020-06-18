<?php

session_start(); // start your memory
require_once('functions.php');

if( $_SESSION ){
  $user = $_SESSION['$jUser'];
  $userId = $user->id;

  if($_POST) {
    $sEmail = $_POST['email'];
    $sPassword = $_POST['password'];
  
    if($user->isAgent == 1) {
      $jData = getFileAsJson(__DIR__.'/agent/agents.json');
      $jData->$userId->email = $sEmail;
      $jData->$userId->password = $sPassword;

        // $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        // $sUniqueImageName = uniqid().'.'.$file_extension;
    
        // move_uploaded_file($sUniqueImageName, __DIR__."/images/$sUniqueImageName");
        // $jData->$userId->image = $sUniqueImageName;
      

      saveJsonToFile($jData, __DIR__.'/agent/agents.json');
      $user->email =$sEmail;
      $user->password =$sPassword;
    } else if($user->isAgent == 0) {
      $jData = getFileAsJson(__DIR__.'/user/users.json');
      $jData->$userId->email = $sEmail;
      $jData->$userId->password = $sPassword;
      saveJsonToFile($jData, __DIR__.'/user/users.json');
      $user->email =$sEmail;
      $user->password =$sPassword;
    }
  }
  
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/app.css">
  <title>Profile</title>
</head>
<body>

<?php
  include('components/header.php');
  echo '<div id="profile-commands">';
  echo '<a href="upload-property.php?id=' . $userId . '">UPLOAD PROPERTY</a>';
  echo '<a href="delete-profile.php?id=' . $userId . '">DELETE</a>';
  echo '</div>';
?>



<div class="main-container">
  <h1>
      Profile page
    </h1>
  <div id="profile-container">

    <div id="profile-information">
      <?php
        echo "<div class='user-info'>Username: $user->email</div><div class='user-info'>Password: $user->password</div>";
      ?>
    </div>
    <div id="edit-profile">
      Edit profile

      <div id="updateForm">
        <form method="POST">
          <input name="email" id="newUserEmail" type="text" placeholder="New email">
          <input name="password" id="newUserPassword" type="text" placeholder="New Password">
          <!-- <div class="imageUpload">
          <div>Upload new profile image</div>
          <input name="image" id="newImage" type="file">
          </div> -->
          <button name="updateFrm" id="btnUpdate" type="submit">UPDATE USER</button>
        </form>
      </div>
    </div>
  </div>
  <?php
    // This is for deleting or updating the property
    if($user->isAgent == 1) {
      $jData = getFileAsJson(__DIR__.'/agent/agents.json');
      $jAgentProperties = $jData->$userId->properties;
      echo "
      <h2>My Properties</h2>
      <div id='list-all-properties-container'>
      
      ";



      foreach( $jAgentProperties as $sPropertyId => $jAgentProperty ){
        echo '
        <div id="'.$userId.'" class="property-container">
        <div class="property-image" style="background-image: url(&#39;'.$jAgentProperty->image.'&#39;);width: 150px; height: 150px;background-size: cover;">
        </div>
        <div class="property-values">
        <div>Price:</div>
        <div class="'.$sPropertyId.' price">'.$jAgentProperty->price.'</div>
        <div>Bedrooms:</div>
        <div class="'.$sPropertyId.' bedrooms">'.$jAgentProperty->bedrooms.'</div>
        <div>Bathrooms:</div>
        <div class="'.$sPropertyId.' ba">'.$jAgentProperty->ba.'</div>
        <div>Suaremeters:</div>
        <div class="'.$sPropertyId.' sqm">'.$jAgentProperty->sqm.'</div>
        </div>
        <details>
          <summary>Edit property</summary>
          <form data-user="'.$userId.'" id="'.$sPropertyId.'" class="property_form">
            <input data-id="'.$userId.'" value="'.$userId.'" type="hidden">
            <input data-update="price" name="txtPrice" value="'.$jAgentProperty->price.'">
            <input data-update="bedrooms" name="txtBedrooms" value="'.$jAgentProperty->bedrooms.'">
            <input data-update="ba" name="txtBathrooms" value="'.$jAgentProperty->ba.'">
            <input data-update="sqm" name="txtSqm" value="'.$jAgentProperty->sqm.'">
            <button type="button" onclick="deleteProperty(this,`'.$sPropertyId.'`,`'. $userId.'`)">Delete</button>
          </form>
        </details>
        </div>
        ';
      } 
      saveJsonToFile($jData, __DIR__.'/agent/agents.json');
    }
    echo "</div>"; 
?>
  </div>
  </div>
  </div>


</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>


<?php

} else if(!$_SESSION) {
  header('Location: index.php');
}
?>