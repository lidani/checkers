<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];
  $gameId = $_SESSION["gameId"];

  $query = $mysqli->query("SELECT * FROM `jogos` WHERE id = '$gameId'");
  $res = $query->fetch_all();
  if (count($res) > 0) {
    if ($res[0][10] == 0 && $res[0][5] == 1) {
      $update = $mysqli->query(
        "UPDATE `jogos` SET `active` = 1 WHERE `id` = '$gameId'"
      );
    } else {
      if (($userId != $res[0][6])) {
        $update = $mysqli->query(
          "UPDATE `jogos` SET `active` = 0, `player2_id` = '$userId'
          WHERE `id` = '$gameId'"
        );
      }
      echo (json_encode($res));
    }
  } else {
    die ("Não foram encontrados registros.");
  }

  if (!$query && !$update){
    die("erro: ". $mysqli->error);
  }

?>
