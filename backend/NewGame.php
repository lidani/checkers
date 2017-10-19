<?php
session_start();
$userId = $_SESSION['id'];
$nome = $_POST['nome'];
$tab = $_POST['tabuleiro'];
$vez = $_POST['vez'];

include 'connection.php';
$stmt = $mysqli->prepare(
  "INSERT INTO `jogos`(id, titulo, tabuleiro, vez, status, jogador1_id) ".
  "VALUES (NULL, ?, ?, ?, 0, ?)"
);
if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}
if (!$stmt->bind_param("sssi", $nome, $tab, $vez, $userId)) {
    die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error
    . "<br />Nome: $nome");
}

if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}
$stmt->close();

header("Location: ../frontend/lobby.php");

?>
