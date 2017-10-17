<?php
$mysqli = new mysqli("localhost", "root", "", "checkers");

if (!$mysqli) {
  die("Aconteceu um erro inesperado: " . $mysqli->connecton_errno());
}

$jogos = "CREATE TABLE IF NOT EXISTS `jogos` (
    id bigint NOT NULL AUTO_INCREMENT,
    titulo varchar(255) NOT NULL,
    tabuleiro varchar(10000) NOT NULL,
    vez int,
    status int,
    jogador1_id bigint,
    jogador2_id bigint,
    rodadas int,
    active boolean,
    winner int,
    empate boolean DEFAULT false,
    PRIMARY KEY (id)
  ) charset=utf8;";

$user = "CREATE TABLE IF NOT EXISTS `users`(
  id bigint AUTO_INCREMENT,
  name varchar(255),
  email varchar(255),
  password varchar(255),
  victories bigint default 0,
  empates int default 0,
  PRIMARY KEY (id)
) charset=utf8;";
if (!$mysqli->query($jogos)) {
  die("Erro ao criar table " . $jogos);
}
if (!$mysqli->query($user)) {
  die("erro ao criar a table: ". $user);
}
?>
