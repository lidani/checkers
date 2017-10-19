<?php
session_start();
$idUser = $_SESSION["id"];

include 'connection.php';

$query = "SELECT * FROM `jogos` WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser'";
$res = $mysqli->query($query);

if (!$res) {
  die("Erro ao query table jogos: " . $mysqli->error());
}

echo (json_encode($res->fetch_all()));
?>
