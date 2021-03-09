<?php
  session_start();
  include 'db_connect.php';
  $conn = connect();

  $name = $_POST['filename'];

  $sql = mysqli_query($conn, 'DELETE FROM images WHERE filename="'.$name.'"');
  $conn->query($sql);

  unlink("images/" . $name);

  sendMessage("Success! The image was deleted successfully.");

  function sendMessage($msg){
    $_SESSION['msg'] = $msg;
    header("Location:index.php");
    exit;
  }
?>
