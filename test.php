<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<section class="signup-container full-view-width full-view-height ja-items-center grid text-center bg-cover" style="background-image: url(images/background.jpg);">
    
    <form class="signup bg-blue grid one-column-grid" method="POST">
    <h1 class="text-center">Signup</h1>
        
    <select name="selectUserType" id="selectUserType">
        <option value="selectAgent">Agent</option>
        <option value="selectUser">User</option>
    </select>
        <div>
        <input class="full-width" name="image" type="file" placeholder="Image">
        <div class="button overlay-layer">Upload photo</div>
        </div>
        <input class="full-width" name="txtFirstName" type="text" placeholder="First Name (2-20 characters)" type="text" maxlength="20" data-type="string" data-min="2" data-max="20" value="Mathias">
        <input class="full-width" name="txtLastName" type="text" placeholder="Last Name (2-20 characters)" type="text" maxlength="20" data-type="string" data-min="2" data-max="20" value="Levin">
        <input class="full-width" name="txtEmail" type="text" placeholder="Email (you@something.com)" type="text" maxlength="30" data-type="string" data-min="2" data-max="20" value="mail@mail.com">
        <input class="full-width" name="txtPassword" type="password" placeholder="Password">
        <input class="full-width" name="txtPasswordConfirmation" type="password" placeholder="Password Confirmation">
        <button class="button full-width bg-black">Signup</button>
    </form>
    </section>
</body>
</html>

<?php
            $sImage = $_FILES['image'];

            // GET INFO FROM IMAGE OBJECT AND PROCESS 
            $sUniqueImageName = 'I'.uniqid(); // generating a unique id
            $sExtension = pathinfo($sImage['name'], PATHINFO_EXTENSION); // getting extension
            $sExtension = strtolower($sExtension); // convert to lowercase

            $sImageFileName = "$sUniqueImageName.$sExtension"; // giving a unique filename // or it could be $_FILES[imgProperty]['name'].$sExtension (will be the original name of the file)
            $sFileSize = $sImage['size'];
            $sTempFilePath = $sImage['tmp_name'];

            $sFilePath = __DIR__."/agent/images/properties/$sImageFileName";

            // MOVE IMAGE INTO IMAGE FOLDER - // 2 arguments: 1) The temporary file [][] <-- a multidimensional associative array , 2) Path of the destination
            move_uploaded_file($sTempFilePath, $sFilePath);