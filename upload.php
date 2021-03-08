<?php
  session_start();
  include 'db_connect.php';
  $conn = connect();

  $sql = mysqli_query($conn, "SELECT MAX(id) FROM images");
  $result = mysqli_fetch_row($sql);
  $img_id = $result[0] + 1;
  echo $img_id;

  $target_dir = "images/";
  $target_file = $target_dir.basename($_FILES["img"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $uploadOk = 1;

  $lat = $_POST['lat'];
  $long = $_POST['long'];

  //check if lat and long are set
  if($lat == "Latitude" || $long == "Longitude"){
    message("error"); 
    //message("Missing latitude and longitude.");   
    $uploadOk = 0;
  }

  //file size check
  if($_FILES["img"]["size"] > 5000000){
    message("error"); 
    //message("Sorry, your file is too large.");
    $uploadOk = 0;
  }

  //format check
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    message("error"); 
    //message("Sorry, only JPG, JPEG and PNG files are allowed.");
    $uploadOk = 0;
  }

  if($uploadOk == 0){
    message("error"); 
    //message("Sorry, your file was not uploaded.");
  }else{
    $name = $img_id.".".$imageFileType;
    if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir.$name)){
      $sql = "INSERT INTO images (filename, latitude, longitude) VALUES ('$name', '$lat', '$long')";

      if(mysqli_query($conn, $sql)){
        message("success"); 
        //message("Your image was uploaded successfully!");
      }else{
        message("error"); 
        //message("ERROR: Was not able to execute $sql. " . mysqli_error($conn));
      }
    }else{
      message("error"); 
      //message("Sorry, there was an error uploading your file.");
    }
  }

  header("Location: index.php");
  exit;

  function message($msg){
    header("Location:index.php?msg=$msg");
    exit;
  }
?>
