<?php
  session_start();
  include 'db_connect.php';
  $conn = connect();

  $sql = mysqli_query($conn, "SELECT MAX(id) FROM images");
  $result = mysqli_fetch_row($sql);
  $img_id = $result[0] + 1;

  $target_dir = "images/";
  $target_file = $target_dir.basename($_FILES["img"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  $lat = $_POST['lat'];
  $long = $_POST['long'];

  //file exists check
  if(!file_exists($_FILES['img']['tmp_name'])){
    sendMessage("Upload error: there was no image selected.");
  }

  //file size check (8MB limit)
  if($_FILES["img"]["size"] > 8000000){
    sendMessage("Upload error: The file was too large. (max. 8MB)");
  }

  //format check
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    sendMessage("Upload error: Only JPG, JPEG and PNG images are allowed.");
  }

  $name = $img_id.".".$imageFileType;
  if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir.$name)){
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO images (filename, latitude, longitude, date_added) VALUES ('$name', '$lat', '$long', '$date')";

    if(mysqli_query($conn, $sql)){
      sendMessage("Success! Your image was uploaded successfully.");
    }else{
      sendMessage("Upload error: There was an error uploading your image.");
    }
  }else{
    sendMessage("Upload error: There was an error uploading your image."); 
  }

  function sendMessage($msg){
    $_SESSION['msg'] = $msg;
    header("Location:index.php");
    exit;
  }
?>
