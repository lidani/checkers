<?php
  session_start();
  include 'connection.php';

  $gameId = $_SESSION["gameId"];

  $select = $mysqli->query("SELECT * FROM `jogos` WHERE `id` = '$gameId'");
  if (!$select) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result = $select->fetch_all();
  echo json_encode($result);
?>
