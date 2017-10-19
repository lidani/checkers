<?php
session_start();

$user = (array)$_SESSION['user'];
$idUser = $user["id"];

$tabuleiro = $_POST["tabuleiro"];
$vez = $_POST["vez"];
$status = $_POST["status"];
$active = $_POST["active"];

include 'connection.php';

$query = "UPDATE `jogos`
  SET `tabuleiro` = '$tabuleiro', `active` = '$active',
  `vez` = '$vez', `status` = '$status', `vez` = 'img/img.png'
  WHERE `jogos`.`jogador1_id` = '$idUser' or `jogos`.`jogador2_id` = '$idUser'
  and `jogos`.`active` = 1;";

if (!$mysqli->query($query)) {
  die("Erro ao alter table: (" . $mysqli->errno . ") " . $mysqli->error);
}

$update = $mysqli->query("SELECT * FROM `jogos` WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser'");

if (!$update){
  echo("Error: ". $mysqli->error());
  die("erro: ". $mysqli->error());
} else {
  $res = $update->fetch_all();
  if (count($res) > 0) {
    echo (json_encode($res));
  }
}

?>
