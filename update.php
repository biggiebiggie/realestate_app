<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
</head>
<body>

<?php
    $sjProperties = file_get_contents(__DIR__.'/properties.json');
    $jProperties = json_decode($sjProperties);
    
    $sPropertyId = $_GET['id'];
?>
<section id="property-single" style="text-align: center">

<h1>Updating product <?= $_GET['id'] ?></h1>
<div class="main-container" style="display: flex; justify-content: center; ">
<div class="container">
    <img src="images/<?= $jProperties->$sPropertyId->image?>" alt="" style="height: 350px; width: 500px;">
</div>

<form action="" method="POST"> 
    <input name="txtPrice" type="text" placeholder="price">
    <button>Update</button>
</form>

</div>
</section>

<?php
if($_POST) {


$jProperties->$sPropertyId->price = $_POST['txtPrice'];
echo $jProperties->$sPropertyId->price;
$sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
file_put_contents(__DIR__.'/properties.json', $sjProperties);
header('Location: properties.php');
}
?>
</body>
</html>