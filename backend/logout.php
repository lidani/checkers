<?php
  session_start();

  unset($_SESSION["id"]);
  unset($_SESSION["name"]);
  unset($_SESSION["email"]);

  session_destroy();
  session_start();
  $_SESSION["logout"] = "Deslogado com sucesso";
  header("Location: ../frontend/login.php");
?>
