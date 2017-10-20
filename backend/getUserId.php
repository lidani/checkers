<?php
  session_start();

  $user = (array)$_SESSION["user"];
  echo $user["id"];
?>
