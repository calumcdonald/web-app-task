<?php
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
  <title>Streamba Web App</title>

  <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
  <link rel="stylesheet" href="libs/leaflet/leaflet.css"/>
  <script src="libs/leaflet/leaflet.js"></script>
</head>

<body>
  <div id="container">
    <div class="sidebar">
      <h1>Streamba Web App</h1>
      <p>Use this app to ... </p>
      <p>Start by clicking a point on the map to add a picture!</p>

      <ul class="form">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <li class="form-item">
            <input hidden class="location" readonly type="text" value="Latitude" id="lat" name="lat">
            <input hidden class="location" readonly type="text" value="Longitude" id="long" name="long">
          </li>
        </form>
      </ul>
      <span class="info">
        <?php
          if(isset($_GET["msg"]) and $_GET["msg"] == "error"){
            echo "There was an error uploading your image.";
          }
          else if(isset($_GET["msg"]) and $_GET["msg"] == "success"){
            echo "Your image was uploaded successfully!";
          }
        ?>
      </span>
    </div>

    <div class="map-container">
      <div id="map"></div>
    </div>
  </div>

  <script src="js/map.js"></script>
  <script type="text/javascript">
    var markers = <?php echo json_encode($rows); ?>;
    
    for(var i = 0; i < markers.length; i++){
      createMarker(markers[i]);
    }
  </script>
</body>
</html>