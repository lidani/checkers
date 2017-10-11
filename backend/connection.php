<?php
$mysqli = new mysqli("localhost", "root", "", "checkers");

if (!$mysqli) {
  die("Aconteceu um erro inesperado: " . $mysqli->connecton_errno());
}
$table = "CREATE TABLE IF NOT EXISTS `game`(
  id int AUTO_INCREMENT,
  pontos_jg1 int,
  pontos_jg2 int,
  tabuleiro varchar(10000),
  rodadas int,
  active boolean,
  finalized boolean,
  winner int,
  empate boolean DEFAULT false,
  PRIMARY KEY (id)
) charset=utf8;";

$jogos = "CREATE TABLE IF NOT EXISTS `games`(
  id int AUTO_INCREMENT,
  n_jogadores int,
  limiteJogadores int DEFAULT 2,
  PRIMARY KEY(id)
) charset=utf8;";

$user = "CREATE TABLE IF NOT EXISTS `users`(
  id int AUTO_INCREMENT,
  name varchar(255),
  email varchar(255),
  password varchar(255),
  PRIMARY KEY (id)
) charset=utf8;";
if (!$mysqli->query($table)) {
  die("Erro ao criar table " . $table);
}
if (!$mysqli->query($jogos)) {
  die("erro ao criar table " . $jogos);
}
if (!$mysqli->query($user)) {
  die("erro ao criar a table: ". $user);
}
?>
