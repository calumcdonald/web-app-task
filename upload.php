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
  $uploadOk = 1;

  $lat = $_POST['lat'];
  $long = $_POST['long'];

  //file exists check
  /*if($_FILES[0] == null){
    send_message("nofile_error");
    $uploadOK = 0;
  }*/

  //file size check(2MB limit)
  if($_FILES["img"]["size"] > 2000000){
    send_message("filesize_error"); 
    //send_message("Sorry, your file is too large.");
    $uploadOk = 0;
  }

  //format check
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    send_message("error"); 
    //send_message("Sorry, only JPG, JPEG and PNG files are allowed.");
    $uploadOk = 0;
  }

  if($uploadOk == 0){
    send_message("error"); 
    //send_message("Sorry, your file was not uploaded.");
  }else{
    $name = $img_id.".".$imageFileType;
    if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir.$name)){
      $sql = "INSERT INTO images (filename, latitude, longitude) VALUES ('$name', '$lat', '$long')";

      if(mysqli_query($conn, $sql)){
        send_message("success"); 
        //send_message("Your image was uploaded successfully!");
      }else{
        send_message("error"); 
        //send_message("ERROR: Was not able to execute $sql. " . mysqli_error($conn));
      }
    }else{
      send_message("error"); 
      //send_message("Sorry, there was an error uploading your file.");
    }
  }

  function send_message($msg){
    header("Location:index.php?msg=$msg");
    exit;
  }
?>
