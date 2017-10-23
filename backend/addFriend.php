<?php
  session_start();
  include 'connection.php';

  $user = (array)$_SESSION["user"];
  $userId = $user["id"];

  $friendId = $_POST["friendId"];
  $friendName = $_POST["friendName"];

  $friends = (object)$_SESSION["friends"];

  $friendList = [];

  $friends = json_encode($friends);

  echo($friends);


  if (count($friends) > 1) {
    array_push($friendList, $friends);
  }


  // if (count($friendList) > 0) {
  //   for ($i=0; $i < count($friends->{'0'}[0]); $i++) {
  //     if ($friendId == $friendList[$i]->{'0'}->{'id'}) {
  //       die("Você já adicionou esse amigo.");
  //       $nextStack = false;
  //       break;
  //     } else {
  //       $nextStack = true;
  //     }
  //   }
  // } else {
  //   $nextStack = true;
  // }
  //
  $nextStack = true;
  if ($nextStack) {
    $friend = (array) [
      'id' => $friendId,
      'name' => $friendName
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
      $_SESSION['friends'] = (array) [
        0 => json_decode($result[0][5])
      ];
    }
    echo json_encode("Amigo adicionado");
  }
?>
