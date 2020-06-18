<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPLOAD YOUR PROPERTY</title>
</head>
<body>
<a href="properties.php">View properties</a>
    <form action="upload.php" method="POST" enctype="multipart/form-data"> <!-- To save images you need enctype (encode type) -->
        <input name="txtPrice" type="text" placeholder="Price">
        <input name="myFile" type="file">
        <button>UPLOAD PROPERTY</button>
    </form>
</body>
</html>