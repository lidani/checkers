<?php
  session_start();
  include 'connection.php';

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $select = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' OR `nickname` = '$email'");
  if (!$select) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  $result = $select->fetch_all();
  if (count($result) > 0) {
    $_SESSION['user'] = (object) [
      'id' => $result[0][0],
      'name' => $result[0][1],
      'email' => $result[0][2],
      'victories' => $result[0][4],
      'nickname' => $result[0][6]
    ];
    $_SESSION['friends'] = (object) [
      0 => [ 0 => json_decode($result[0][5])]
    ];
    echo json_encode("Usuário logado");
  } else {
    die("E-mail ou senha inválidos");
  }
?>
