<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Properties</title>
</head>
<body>
    <a href="form.php">Upload property</a>
    <div class="container">


    <?php
    $sjProperties = file_get_contents(__DIR__.'/properties.json');
    $jProperties = json_decode($sjProperties);

    $sBluePrint = '
    <div class="property">
        <div>${{price}}</div>
        <img style="width: 100px; height: 100px;" src="images/{{path}}" alt="">
        <a href="delete.php?id={{id}}">DELETE</a>
        <a href="update.php?id={{id}}">Update</a>
    </div>
    ';

    foreach($jProperties as $u => $jProperty) {
        echo $u;
        $sCopyBluePrint = $sBluePrint;

        $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{path}}', $jProperty->image, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{id}}', $u, $sCopyBluePrint);

        echo $sCopyBluePrint;
    }
    ?>

    </div>
</body>
</html>