<?php
  session_start();

  unset($_SESSION["user"]);
  unset($_SESSION["gameId"]);
  unset($_SESSION["friends"]);

  session_destroy();

  echo json_encode("Deslogado");
?>
