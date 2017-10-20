<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $idUser = $user["id"];
  $active = $_GET["active"];
  $gameId = $_SESSION["gameId"];

  $query = $mysqli->query("SELECT * FROM `jogos` WHERE id = '$gameId'");
  $res = $query->fetch_all();
  if (count($res) > 0) {
    if (($idUser != $res[0][6])) {
      $update = $mysqli->query("UPDATE `jogos` SET `active` = 1, `jogador2_id` = '$idUser' WHERE `active` = NULL");
    } else {
      $update = $mysqli->query("UPDATE `jogos` SET `active` = 1 WHERE `active` = NULL");
    }
    echo (json_encode($res));
  } else {
    die ("Não foram encontrados registros.");
  }

  if (!$query && !$update){
    echo("Error: ". $mysqli->error());
    die("erro: ". $mysqli->error());
  }

?>
