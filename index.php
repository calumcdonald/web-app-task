<!DOCTYPE html>
<html>

<head>
  <title>Streamba Web App</title>

  <link rel="stylesheet" href="css/stylesheet.css" type="text/css">
  <link rel="stylesheet" href="libs/leaflet/leaflet.css"/>
  <script src="libs/leaflet/leaflet.js"></script>

  <!--
  <link rel="stylesheet" href="libs/bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css"/>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="libs/bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
  -->
</head>

<body>
  <div id="container">
    <div class="split left">
      <h1>Streamba Web App</h1>
      <ul class="form">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <li class="form-item">
            Click a point on the map for where you want to add a picture.<br>
            <input class="location" readonly type="text" value="Latitude" id="lat" name="lat">
            <input class="location" readonly type="text" value="Longitude" id="long" name="long">
          </li>
        </form>
      </ul>
      <span class="info">
        <?php
          if(isset($_GET["msg"])){
            echo $_GET["msg"];
          }
        ?>
      </span>
    </div>

    <div class="split right">
      <div id="map"></div>
    </div>
  </div>

  <script src="js/map.js"></script>
</body>

</html>
