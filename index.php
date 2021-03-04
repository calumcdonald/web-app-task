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
    <div id="sidebar">
      <h1>Streamba Web App</h1>
      <ul class="form">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <li class="form-item">
            Select image to upload:<br>
            <input type="file" name="img" id="img">
          </li>
          <li class="form-item">
            <input class="location" readonly type="text" value="Latitude" id="lat" name="lat">
          </li>
          <li class="form-item">
            <input class="location" readonly type="text" value="Longitude" id="long" name="long">
          </li>
          <li class="form-item">
            <input type="submit" value="Submit" name="submit">
          </li>
        </form>
      </ul>
      <p id="info"></p>
    </div>

    <div id="map"></div>
  </div>

  <script src="js/map.js"></script>
</body>

</html>
