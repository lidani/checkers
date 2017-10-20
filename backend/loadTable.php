<?php
  session_start();
  include 'connection.php';

  $idUser = $_GET["userId"];
  $active = $_GET["active"];

  $query = $mysqli->query("SELECT * FROM `jogos` WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser' AND `active` = NULL");
  $res = $query->fetch_all();
  if (count($res) > 0) {
    if ($res[0][0] != $res[0][6] && $res[0][7] == null) {
      $update = $mysqli->query("UPDATE `jogos` SET `active` = 1, `jogador2_id` = '$idUser' WHERE jogador1_id = '$idUser' or jogador2_id = '$idUser' AND `active` = NULL");

    }
    echo (json_encode($res));
  }

  if (!$query && !$update){
    echo("Error: ". $mysqli->error());
    die("erro: ". $mysqli->error());
  }


?>
