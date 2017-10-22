<?php
  include 'connection.php';

  $name = $_GET["name"];

  $select = $mysqli->query("SELECT * FROM `users` WHERE `name` = '$name' OR `nickname` = '$name'");
  if (!$select) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result = $select->fetch_all();

  if (count($result) > 0) {
    echo json_encode($result);
  } else {
    die("Nenhum registro encontrado.");
  }

?>
