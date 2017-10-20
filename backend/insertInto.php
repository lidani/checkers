<?php
  session_start();

  $user = (array)$_SESSION['user'];
  $userId = $user["id"];

  $board = $_POST["board"];
  $turn = $_POST["turn"];
  $status = $_POST["status"];
  $active = $_POST["active"];
  $gameId = $_SESSION["gameId"];

  include 'connection.php';

  $query = "UPDATE `jogos`
    SET `board` = '$board', `active` = '$active',
    `turn` = '$turn', `status` = '$status',
    WHERE `id` = '$gameId'";

  if (!$mysqli->query($query)) {
    die("Erro " . $mysqli->errno . $mysqli->error);
  }

  $resp = $mysqli->query(
    "SELECT * FROM `jogos` WHERE `id` = '$gameId'"
  );

  if (!$resp){
    die("erro: ". $mysqli->error);
  } else {
    $res = $resp->fetch_all();
    if (count($res) > 0) {
      if ($userId != $res[0][6]) {
        $update = $mysqli->query(
          "UPDATE `jogos` SET `jogador2_id` = '$userId' WHERE `id` = '$gameId'"
        );
      }
      $resp2 = $mysqli->query(
        "SELECT * FROM `jogos` WHERE `id` = '$gameId'"
      );
      $res2 = $resp2->fetch_all();
      if (count($res2) > 0) {
        echo (json_encode($res2));
      }
    }
  }
?>
