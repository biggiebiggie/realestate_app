<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/app.css">

  <script src='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css' rel='stylesheet' />
  

  <title>Document</title>
</head>
<body>

  <?php
  session_start();
    include('components/header.php');
  ?>

  <div id="search_container">
      <?php include('search.html') ?>
  </div>

  <div id="map_properties">

    <div id='map'></div>

    <div id="properties">
    
      <?php
      require_once('functions.php');

      $aProperties = [];
  
      $jData = getFileAsJson(__DIR__.'/agent/agents.json');

      foreach($jData as $jUser){
        foreach($jUser->properties as $key=>$jProperty) {

            echo '<div id=Right'.$key.' class="property">
            <img src="'.$jProperty->image.'">
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
            </div>
            ';
        array_push($aProperties, $jProperty);
        
        }
    }

    
      ?>
    </div>
  </div>

  <script>
      const sjProperties = '<?php echo json_encode($aProperties);?>'
      ajProperties = JSON.parse(sjProperties) // convert text into an object
      console.log(ajProperties)

      mapboxgl.accessToken = 'pk.eyJ1Ijoic2FudGlhZ29kb25vc28iLCJhIjoiY2swYzVoYmNmMHlkZzNibzR4NTNxamU3cSJ9.QNJx-cfl48aSOx8purGNeA';
      var map = new mapboxgl.Map({
      container: 'map',
      center: [12.555050, 55.704001], // starting position
      zoom: 12, // starting zoom
      style: 'mapbox://styles/santiagodonoso/ck0c6jrhh02va1cnp07nfsv64'
      
      });
      map.addControl(new mapboxgl.NavigationControl());

    // JSON works with for in loops
    // Arrays work with forEach and also with for of
    for( let jProperty of ajProperties ){ // json object with json objects in it
    
      var el = document.createElement('a');
      el.href = '#Right'+jProperty.id
      el.className = 'marker'
      el.style.backgroundImage = 'url("images/marker.png")';
      el.style.backgroundSize = 'contain';
      el.style.width = "50px"
      el.style.height = "50px"
      el.id = jProperty.id
      el.addEventListener('click', function() {
        console.log(`Highlight property with ID ${this.id} `);
        removeActiveClassFromProperty()
        document.getElementById(this.id).classList.add('active') // left
        document.getElementById('Right'+this.id).classList.add('active') // right
      });

    // add marker to map
    new mapboxgl.Marker(el).setLngLat(jProperty.geometry.coordinates).addTo(map);      
  } // end loop

    // $('.active').removeClass('.active')
    function removeActiveClassFromProperty(){
      let properties = document.querySelectorAll('.active')
      properties.forEach( function( oPropertyDiv ) {
        oPropertyDiv.classList.remove('active')
      } )
    }


    </script>

  <script src="js/app.js"></script>

</body>
</html>