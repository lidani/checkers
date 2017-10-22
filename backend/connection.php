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
      size int DEFAULT 8,
      status int DEFAULT 0,
      player1_id bigint,
      player2_id bigint,
      player1_points int DEFAULT 0,
      player2_points int DEFAULT 0,
      active boolean DEFAULT false,
      winner_id bigint,
      winner varchar(64),
      creation varchar(128),
      PRIMARY KEY (id)
    ) charset=utf8;";

  $user = "CREATE TABLE IF NOT EXISTS `users`(
    id bigint NOT NULL AUTO_INCREMENT,
    name varchar(255),
    email varchar(255) NOT NULL,
    password varchar(255),
    victories int default 0,
    friends varchar(255),
    nickname varchar(255) NOT NULL,
    UNIQUE(nickname),
    UNIQUE(email),
    PRIMARY KEY (id)
  ) charset=utf8;";
  
  if (!$mysqli->query($user)) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (!$mysqli->query($jogos)) {
    die("Error: (" . $mysqli->errno . ") " . $mysqli->error);
  }
?>
