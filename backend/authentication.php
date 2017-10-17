<?php
session_start();
$email = $_POST['email'];
$senha = md5($_POST['password']);

include 'connection.php';

$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$senha'";
$res = $mysqli->query($sql);
if (!$res) {
  die($mysqli->error."<br />Error querying testes table.<br />$sql");
}
$registros = $res->fetch_all();
if (count($registros) > 0) {
  $_SESSION['id'] = $registros[0][0];
  $_SESSION['name'] = $registros[0][1];
  $_SESSION['email'] = $registros[0][2];
  $_SESSION['victories'] = $registros[0][4];
  $_SESSION['empates'] = $registros[0][5];
  header("Location: ../frontend/index.php");
} else {
  $_SESSION["errorLogin"] = "E-mail ou senha inválida";
  header("Location: ../frontend/login.php");
}
?>
