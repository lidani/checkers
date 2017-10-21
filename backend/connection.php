<?php
$mysqli = new mysqli("localhost", "root", "", "checkers");

if (!$mysqli) {
  die("Aconteceu um erro inesperado: " . $mysqli->connection_errno());
}

$jogos = "CREATE TABLE IF NOT EXISTS `jogos` (
    id bigint NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    board varchar(6000),
    turn varchar(64),
    size int(11) DEFAULT 8,
    status int DEFAULT 0,
    player1_id bigint,
    player2_id bigint,
    player1_points int DEFAULT 0,
    player2_points int DEFAULT 0,
    active boolean DEFAULT false,
    winner_id bigint,
    winner varchar(64),
    PRIMARY KEY (id)
  ) charset=utf8;";

$user = "CREATE TABLE IF NOT EXISTS `users`(
  id bigint AUTO_INCREMENT,
  name varchar(255),
  email varchar(255),
  password varchar(255),
  victories bigint default 0,
  PRIMARY KEY (id)
) charset=utf8;";

if (!$mysqli->query($jogos)) {
  die("Erro ao criar table " . $mysqli->error . $jogos);
}
if (!$mysqli->query($user)) {
  die("erro ao criar a table: ". $user);
}
?>
