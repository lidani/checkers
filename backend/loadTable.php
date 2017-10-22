<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];
  $gameId = $_SESSION["gameId"];

  $query = $mysqli->query("SELECT * FROM `jogos` WHERE id = '$gameId'");
  $res = $query->fetch_all();
  if (!$res) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (count($res) > 0) {
    if ($res[0][10] == 0 && $res[0][5] == 0) {
      $update = $mysqli->query("UPDATE `jogos` SET `active` = 1 WHERE `id` = '$gameId'");
      if (!$update) {
        die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
      }
    } else {
      if ($res[0][7] == null) {
        if ($res[0][6] != $userId && $res[0][10] == 1) {
          $update = $mysqli->query("UPDATE `jogos` SET `active` = 1, `player2_id` = '$userId'
            WHERE `id` = '$gameId'");
          if (!$update) {
            die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
          }
        }
      }
      $query2 = $mysqli->query("SELECT * FROM `jogos` WHERE id = '$gameId'");
      $res2 = $query2->fetch_all();
      if (!$res2) {
        die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
      }
      echo json_encode($res2);
    }
  } else {
    die ("Não foram encontrados registros.");
  }

?>
