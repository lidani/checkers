<?php
session_start();

$user = (array)$_SESSION['user'];
$idUser = $user["id"];

include 'connection.php';

$query = "SELECT * FROM `jogos` WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser'";
$res = $mysqli->query($query);

if (!$res) {
  die("Erro ao query table jogos: " . $mysqli->error());
}

echo (json_encode($res->fetch_all()));
?>
