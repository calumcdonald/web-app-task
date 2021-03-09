<?php
  session_start();
  include 'db_connect.php';
  $conn = connect();

  $rows = [];
  $count = 0;
  $sql = mysqli_query($conn, "SELECT * FROM images");
  while($row = mysqli_fetch_assoc($sql)) {
    $rows[$count] = $row;
    $count++;
  }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Pothole Reporter</title>

  <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
  <link rel="stylesheet" href="libs/leaflet/leaflet.css"/>
  <script src="libs/leaflet/leaflet.js"></script>
</head>

<body>
  <div id="container">
    <div class="sidebar">
      <input hidden id="collapsible" type="checkbox" class="toggle" checked>
      <label for="collapsible" class="lbl-toggle">
        <h1>Pothole Reporter</h1>
        <span class="down"></span></h1>
      </label>
      </input>
      <div class="content">
        <p>Use this app to report and view potholes, anywhere in the world!</p>
        <p>You can upload images, and also delete them; for when a pothole gets filled in. (if it ever does...)</p>
        <p>Start by clicking a location on the map!</p>

        <?php
          if(isset($_SESSION['msg'])){
            echo "<p style='color: purple;'>".$_SESSION['msg']."</p>";
            unset($_SESSION['msg']);
          } 
        ?>
      </div>
    </div>

    <div class="map-container">
      <div id="map"></div>
    </div>
  </div>

  <script src="js/map.js"></script>
  <script type="text/javascript" src="js/collapsible.js"></script>
  <script type="text/javascript">
    var markers = <?php echo json_encode($rows); ?>;
    
    for(var i = 0; i < markers.length; i++){
      createMarker(markers[i]);
    }
  </script>
</body>
</html>