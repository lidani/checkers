<?php
session_start();

$user = (array)$_SESSION['user'];
$idUser = $user["id"];

$tabuleiro = $_POST["tabuleiro"];
$vez = $_POST["vez"];
$status = $_POST["status"];
$active = $_POST["active"];
$gameId = $_SESSION["gameId"];

include 'connection.php';


$query = "UPDATE `jogos`
  SET `tabuleiro` = '$tabuleiro', `active` = '$active',
  `vez` = '$vez', `status` = '$status', `vez` = '$vez'
  WHERE `id` = '$gameId';";

if (!$mysqli->query($query)) {
  die("Erro ao alter table: (" . $mysqli->errno . ") " . $mysqli->error);
}

$resp = $mysqli->query("SELECT * FROM `jogos` WHERE `id` = '$gameId'");

if (!$resp){
  echo("Error: ". $mysqli->error());
  die("erro: ". $mysqli->error());
} else {
  $res = $resp->fetch_all();
  if (count($res) > 0) {
    if ($idUser != $res[0][6]) {
      $update = $mysqli->query("UPDATE `jogos` SET `jogador2_id` = '$idUser' WHERE `id` = '$gameId'");
    }
    $resp2 = $mysqli->query("SELECT * FROM `jogos` WHERE `id` = '$gameId'");
    $res2 = $resp2->fetch_all();
    if (count($res2) > 0) {
      echo (json_encode($res2));
    }
  }
}

?>
