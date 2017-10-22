<?php
  session_start();

  include 'connection.php';

  $user = $_SESSION['user'];
  $userId = $user->{'id'};
  $friends = $_SESSION["friends"];

  $games = [];
  $gameList = [];

  $select = $mysqli->query("SELECT * FROM `jogos` WHERE `player1_id` = $userId OR `player2_id` = $userId");
  if (!$select) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result = $select->fetch_all();
  if (count($result) > 0) {
    array_push($games, $result);
  }

  if (count($friends->{'0'}[0]) > 0) {
    for ($i = 0; $i < count($friends->{'0'}[0]); $i++) {
      $friend = $friends->{'0'}[0][$i]->{'0'}->{'id'};
      $select2 = $mysqli->query("SELECT * FROM `jogos` WHERE `player1_id` = $friend OR `player2_id` = $friend");
      if (!$select2) {
        die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
      }
      $result2 = $select2->fetch_all();
      if (count($result2) > 0) {
        array_push($games, $result2);
      }
    }
  }

  array_push($gameList, $games);
  echo json_encode($gameList);

?>
