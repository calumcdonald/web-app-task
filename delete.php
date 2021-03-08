<?php
  session_start();
  include 'db_connect.php';
  $conn = connect();

  $name = $_POST['filename'];

  $sql = mysqli_query($conn, 'DELETE FROM images WHERE filename="'.$name.'"');
  $conn->query($sql);

  unlink("images/" . $name);

  send_message("delete_success");

  function send_message($msg){
    header("Location:index.php?msg=$msg");
    exit;
  }
?>
