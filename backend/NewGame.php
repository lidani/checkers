<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION['user'];
  $userId = $user["id"];

  $title = $_POST['title'];
  $board = $_POST['board'];
  $turn = $_POST['turn'];
  $size = $_POST['size'];
  $date = new DateTime(null, new DateTimeZone('FNT'));
  $data = $date->format('d-m-Y H:i:sP');

  $stmt = $mysqli->prepare(
    "INSERT INTO `jogos` (id, title, board, turn, size, player1_id, creation)
    VALUES (NULL, ?, ?, ?, ?, ?, ?)"
  );

  if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (!$stmt->bind_param("sssiis", $title, $board, $turn, $size, $userId, $data)) {
    die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
  }
  if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
  }
  $stmt->close();

  echo json_encode("Sala criada");
?>
