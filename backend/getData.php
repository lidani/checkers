<?php
session_start();

$gameId = $_SESSION["gameId"];

include 'connection.php';

$query = "SELECT * FROM `jogos` WHERE `id` = '$gameId'";
$res = $mysqli->query($query);

if (!$res) {
  die("Erro ao query table jogos: " . $mysqli->error());
}

echo json_encode($res->fetch_all());
?>
