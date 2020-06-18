<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

/* Array ( [myFile] => Array ( 
    [name] => 1.jpg
    [type] => image/jpeg
    [tmp_name] => /opt/lampp/temp/phpzlcnkk
    [error] => 0
    [size] => 72263 ) DIFFERENT KEYS IN THE ASSOCIATIVE ARRAY */

    echo "<div>SIZE: {$_FILES['myFile']['size']} bytes</div>";
    echo "<div>NAME: {$_FILES['myFile']['name']}</div>";
    echo "<div>TYPE: {$_FILES['myFile']['type']}</div>";
    echo "<div>TEMP: {$_FILES['myFile']['tmp_name']}</div>";

    $file_extension = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
    $sUniqueImageName = uniqid().'.'.$file_extension;

    move_uploaded_file($_FILES['myFile']['tmp_name'], __DIR__ ."/images/$sUniqueImageName"); // First argument is the path where its located now, 2nd is where you want to move it to

    $sPrice = $_POST['txtPrice'];

    $jProperty = new stdClass();
    $jProperty->price = intVal($sPrice);
    $jProperty->image = $sUniqueImageName;
    
    echo json_encode($jProperty);
    $sjProperties = file_get_contents(__DIR__.'/properties.json');
    $jProperties = json_decode($sjProperties);
    $sPropertyUniqueId = uniqid();
    $jProperties->$sPropertyUniqueId = $jProperty;
    $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/properties.json', $sjProperties);
    
?>
    <a href="form.php">Upload another property</a>
    <a href="properties.php">View properties</a>
</body>
</html>