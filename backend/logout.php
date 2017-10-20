<?php
  session_start();

  unset($_SESSION["user"]);
  unset($_SESSION["gameId"]);

  session_destroy();

  if (session_status() == 1) {
    echo json_encode("Deslogado");
  };
?>
