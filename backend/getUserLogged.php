<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];

  if (array_key_exists("id", $_GET)) {
    $id = $_GET['id'];
    $getUser = "SELECT * FROM `users` WHERE `id` = '$id'";
  } else {
    $getUser = "SELECT * FROM `users` WHERE `id` = '$userId'";
  }

  $query = $mysqli->query($getUser);
  if (!$query) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result = $query->fetch_all();
  echo json_encode($result);

?>
