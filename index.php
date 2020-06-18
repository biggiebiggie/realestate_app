<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loyal Company</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="login.php">LOGIN</a>
    <a href="sign-up.php">SIGN-UP</a>
</header>
    <section>
        <div class="main-container">
            <div id="google-map" class="half-container">hello</div>
            <div id="properties" class="half-container">

                <?php
                // Open the content of the file / Read the file
                $sjProperties = file_get_contents('data.json');
                // Convert it into an object
                $jProperties = json_decode($sjProperties);
                // Loop through the propertiess

                foreach($jProperties->agents->agent1->properties as $jProperty) {
                    echo '<div class="property">
                    <img src="assets/'. $jProperty->image .'">
                    <div class="property_row_1">
                        <div class="property_row_1_left">
                            <div>$'.$jProperty->price.'</div>
                        </div>
                        <div class="property_row_1_right">
                            <div class="wrapper">
                                <div>'.$jProperty->bedrooms.' bds</div>
                                <div>'.$jProperty->ba.' ba</div>
                                <div>'.$jProperty->sqm.' sqm</div>
                            </div>
                        </div>
                    </div>
                </div>';

                }
                // Display the properties
                ?>
            </div>
    </section>
</body>


</html>