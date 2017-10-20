<?php
session_start();
$user = (array)$_SESSION['user'];

$userId = $user["id"];
$title = $_POST['title'];
$board = $_POST['board'];
$turn = $_POST['turn'];

include 'connection.php';
$stmt = $mysqli->prepare(
  "INSERT INTO `jogos` (id, title, board, turn, player1_id) ".
  "VALUES (NULL, ?, ?, ?, ?)"
);
if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}
if (!$stmt->bind_param("sssi", $title, $board, $turn, $userId)) {
    die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
}
if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}
$stmt->close();

echo json_encode("Sala criada");

?>
