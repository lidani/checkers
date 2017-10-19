<?php
  session_start();
  include 'connection.php';

  $idUser = $_SESSION["id"];

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
