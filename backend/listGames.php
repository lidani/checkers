<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION['user'];
  $userId = $user["id"];

  $myGames = [];
  $friendsGames = [];
  $gamesIAlreadyPlayed = [];
  $gamesFinalized = [];
  $allGames = [];

  if (isset($_SESSION["friends"])) {
    $friends = (array)$_SESSION["friends"];
    for ($i=0; $i < count($friends[0]); $i++) {
      $friendId = $friends[0][$i][0];
      $selectFriend = $mysqli->query("SELECT * FROM `jogos` WHERE `player1_id` = '$friendId' AND `status` = 0");
      if (!$selectFriend) {
        die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
      }
      $result1 = $selectFriend->fetch_all();
      if (count($result1) > 0) {
        array_push($friendsGames, $result1);
      }
    }
  }

  $selectFinalized = $mysqli->query("SELECT * FROM `jogos` WHERE `player1_id` = '$userId' AND `active` = 0 AND `status` = 1");
  $resultFinalized = $selectFinalized->fetch_all();
  if (!$selectFinalized) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (count($resultFinalized) > 0) {
    array_push($gamesFinalized, $resultFinalized);
  }

  $selectMy = $mysqli->query("SELECT * FROM `jogos` WHERE `player1_id` = '$userId' AND `status` = 0 OR `status` = 1");
  if (!$selectMy) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result2 = $selectMy->fetch_all();
  if (count($result2) > 0) {
    array_push($myGames, $result2);
  }

  $selectIAlready = $mysqli->query("SELECT * FROM `jogos` WHERE `player2_id` = '$userId' AND `status` = 2");
  if (!$selectIAlready) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result3 = $selectIAlready->fetch_all();
  if (count($result3) > 0) {
    array_push($gamesIAlreadyPlayed, $result3);
  }

  array_push($allGames, $myGames, $friendsGames, $gamesIAlreadyPlayed, $gamesFinalized);

  echo json_encode($allGames);

?>
