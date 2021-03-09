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
    send_message("nofile_upload_error");
  }

  //file size check(2MB limit)
  if($_FILES["img"]["size"] > 2000000){
    send_message("filesize_upload_error"); 
  }

  //format check
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    send_message("extension_upload_error"); 
  }

  $name = $img_id.".".$imageFileType;
  if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir.$name)){
    $sql = "INSERT INTO images (filename, latitude, longitude) VALUES ('$name', '$lat', '$long')";

    if(mysqli_query($conn, $sql)){
      send_message("upload_success"); 
    }else{
      send_message("error"); 
    }
  }else{
    send_message("error"); 
  }

  function send_message($msg){
    header("Location:index.php?msg=$msg");
    exit;
  }
?>
