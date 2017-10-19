<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION['user'];
  $idUser = $user["id"];
  $active = $_GET["active"];

  $query = $mysqli->query("SELECT * FROM `jogos` WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser'");
  $update = $mysqli->query("UPDATE `jogos` SET `active` = 1 WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser' AND `active` = NULL");
  if (!$query && !$update){
    echo("Error: ". $mysqli->error());
    die("erro: ". $mysqli->error());
  } else {
    $res = $query->fetch_all();
    if (count($res) > 0) {
      echo (json_encode($res));
    }
  }

?>
