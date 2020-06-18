<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DELETE</title>
</head>
<body>
    <h1>Deleting product <?= $_GET['id'] ?></h1>

    <?php
    // Open the file
    $sjProperties = file_get_contents(__DIR__.'/properties.json');
    $jProperties = json_decode($sjProperties);

    $sPropertyId = $_GET['id'];
    unset($jProperties->$sPropertyId);
    echo $sjProperties;
    $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/properties.json', $sjProperties);
    ?>
</body>
</html>