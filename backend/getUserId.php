<?php
  session_start();

  $user = (array)$_SESSION["user"];
  $userArr = (array) [
    0 => $user['id'],
    1 => $user['nickname']
  ];
  echo json_encode($userArr);
?>
