<?php
  include 'db_connect.php';
  $conn = connect();

  $target_dir = "images/";
  $target_file = $target_dir.basename($_FILES["img"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  $lat = $_POST['lat'];
  $long = $_POST['long'];

  //check if lat and long are set
  if($lat == "Latitude" || $long == "Longitude"){
    echo "Missing latitude and longitude.";
    $uploadOk = 0;
  }

  //file size check
  if($_FILES["img"]["size"] > 500000){
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  //format check
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
  }

  if($uploadOk == 0){
    echo "Sorry, your file was not uploaded.";
  }else{
    if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
      $name = $_FILES["img"]["name"];
      $sql = "INSERT INTO images (img_name, img_lat, img_long) VALUES ('$name', '$lat', '$long')";

      if(mysqli_query($conn, $sql)){
        echo "Records added successfully.";
      }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }

      echo "The file ". htmlspecialchars(basename( $_FILES["img"]["name"])). " has been uploaded.";
    }else{
      echo "Sorry, there was an error uploading your file.";
    }
  }

  close($conn); 
?>
