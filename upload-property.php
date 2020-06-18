<?php

    session_start();
    $userId = $_GET['id'];
    $user = $_SESSION['$jUser'];

    if( $_POST ) {
        require_once( __DIR__.'/functions.php' );
        if($user->isAgent == 1) {
            
            $jProperty = new stdClass();
            $jProperty->price = $_POST['price'];
            $jProperty->bedrooms = $_POST['bedrooms'];
            $jProperty->ba = $_POST['ba'];
            $jProperty->sqm = $_POST['sqm'];
            $jProperty->zipcode = $_POST['zipcode'];

            if (isset($_FILES['image'])) {

                $sImage = $_FILES['image'];
        
                // GET INFO FROM IMAGE OBJECT AND PROCESS 
                $sUniqueImageName = uniqid(); // generating a unique id
                $sExtension = pathinfo($sImage['name'], PATHINFO_EXTENSION); // getting extension
                $sExtension = strtolower($sExtension); // convert to lowercase
        
                $sImageFileName = "$sUniqueImageName.$sExtension"; // giving a unique filename // or it could be $_FILES[imgProperty]['name'].$sExtension (will be the original name of the file)
                $sFileSize = $sImage['size'];
                $sTempFilePath = $sImage['tmp_name'];
        
                $sFilePath = "images/$sImageFileName";
        
                // MOVE IMAGE INTO IMAGE FOLDER - // 2 arguments: 1) The temporary file [][] <-- a multidimensional associative array , 2) Path of the destination
                move_uploaded_file($sTempFilePath, $sFilePath);
                
                $jProperty->image = $sFilePath;
            }
            
            $jProperty->geometry = new stdClass();
            $jProperty->geometry->coordinates = [12.5561659999999992720631780684925615787506103515625,
            55.7000000000000028421709430404007434844970703125];
            $jProperty->geometry->type = "Point";
            
            $jProperty->properties = new stdClass();
            $jProperty->properties->iconSize = [20, 20];
            $jProperty->properties->message = "Foo";
            
            $jProperty->type = "Feature";

            $propertyId = uniqid();
            $jProperty->id = $propertyId;
            $jData = getFileAsJson(__DIR__.'/agent/agents.json');

            
            $jData->$userId->properties->$propertyId = $jProperty;
             
        }

            saveJsonToFile($jData, __DIR__.'/agent/agents.json');
            header("Location: profile.php?id=$userId");      
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>Upload Property</title>
</head>
<body>
<section id="upload-section">
    <form id="frmUpload" action="" method="POST" enctype="multipart/form-data">
    <div>Price</div>
        <input name="price" type="text" placeholder="Price" value="5">
    <div>Bedrooms</div>
        <input name="bedrooms" type="text" placeholder="Bedrooms" value="5">
    <div>Bathrooms</div>
        <input name="ba" type="text" placeholder="Bathrooms" value="5">
    <div>Squaremeters</div>
        <input name="sqm" type="text" placeholder="Squaremeters" value="5">
    <div>Zipcode</div>
        <input name="zipcode" type="text" placeholder="Zipcode" value="5">
    <div>Image</div>
        <input name="image" type="file">
        <button>Upload Property</button>
    </form>
</section>
</body>
</html>