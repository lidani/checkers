<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];

  $friendId = $_POST["friendId"];
  $friendName = $_POST["friendName"];

  $friendList = [];

  if (isset($_SESSION["friends"])) {
    $friends = (array)$_SESSION["friends"];
    for ($i=0; $i < count($friends[0]); $i++) {
      array_push($friendList, [
        0 => $friends[0][$i][0],
        1 => $friends[0][$i][1]
      ]);
    }
  }
  
  if (count($friendList) > 0) {
    for ($i=0; $i < count($friendList); $i++) {
      if ($friendId == $friendList[$i][0]) {
        die("Você já adicionou esse amigo.");
        $nextStack = false;
        break;
      } else {
        $nextStack = true;
      }
    }
  } else {
    $nextStack = true;
  }

  if ($nextStack) {
    $newFriend = [
      0 => $friendId,
      1 => $friendName
    ];
    array_push($friendList, $newFriend);
    $friends = json_encode($friendList);
    $update = $mysqli->query("UPDATE `users` SET `friends` = '$friends' WHERE `id` = '$userId'");
    if (!$update) {
      die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $select = $mysqli->query("SELECT * FROM `users` WHERE `id` = '$userId'");
    if (!$select) {
      die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $result = $select->fetch_all();
    if (count($result) > 0) {
      $_SESSION['friends'] = [
        0 => json_decode($result[0][5])
      ];
    }
    echo json_encode("Amigo adicionado");
  }
?>
