<?php
session_start();
$email = $_POST['email'];
$password = md5($_POST['password']);

include 'connection.php';

$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
$res = $mysqli->query($sql);
if (!$res) {
  die($mysqli->error."<br />Error querying testes table.<br />$sql");
}
$registros = $res->fetch_all();
if (count($registros) > 0) {
  $_SESSION['user'] = array(
    'id' => $registros[0][0],
    'name' => $registros[0][1],
    'email' => $registros[0][2],
    'victories' => $registros[0][4],
  );
  echo json_encode($_SESSION['user']);
} else {
  echo "E-mail ou senha inválidos";
}
?>
