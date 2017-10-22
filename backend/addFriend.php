<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];

  $friendId = $_POST["friendId"];
  $friendName = $_POST["friendName"];

  $friends = $_SESSION["friends"];
  $friendList = (array) $friends->{'0'}[0];

  if ($friendList != null) {
    for ($i=0; $i < count($friends->{'0'}[0]); $i++) {
      if ($friendId == $friendList[$i]->{'0'}->{'id'}) {
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
    $friend = (object) [
      0 => [
        'id' => $friendId,
        'name' => $friendName
      ]
    ];
    array_push($friendList, $friend);
    $newFriend = json_encode($friendList);
    $update = $mysqli->query("UPDATE `users` SET `friends` = '$newFriend' WHERE `id` = '$userId'");
    if (!$update) {
      die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $select = $mysqli->query("SELECT * FROM `users` WHERE `id` = '$userId'");
    if (!$select) {
      die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
    }
    $result = $select->fetch_all();
    if (count($result) > 0) {
      $_SESSION['friends'] = (object) [
        0 => [ 0 => json_decode($result[0][5])]
      ];
    }
    echo json_encode("Amigo adicionado");
  }
?>
