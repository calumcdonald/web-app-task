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

  function statusMessage($msg){
    if($msg == "nofile_upload_error"){
      echo "<span style='color: red;'>Upload error: there was no image selected.</span>";
    }
    else if($msg == "filesize_upload_error"){
      echo "<span style='color: red;'>Upload error: The file was too large. (max. 2MB)</span>";
    }
    else if($msg == "extension_upload_error"){
      echo "<span style='color: red;'>Upload error: Only JPG, JPEG and PNG images are allowed.</span>";
    }
    else if($msg == "error"){
      echo "<span style='color: red;'>Upload error: There was an error uploading your image.</span>";
    }
    else if($msg == "upload_success"){
      echo "<span style='color: green;'>Success! Your image was uploaded successfully.</span>";
    }
    else if($msg == "delete_success"){
      echo "<span style='color: green;'>Success! The image was deleted successfully.</span>";
    }
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
      <h1>Pothole Reporter</h1>
      <p>Use this app to report and view potholes, anywhere in the world!</p>
      <p>You can upload images, and also delete them; for when a pothole gets filled in. (if it ever does...)</p>
      <p>Start by clicking a location on the map!</p>

      <?php
        if(isset($_GET["msg"])){
          statusMessage($_GET["msg"]);
        } 
      ?>
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