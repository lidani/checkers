<?php
  if (isset($_SESSION["user"])) {
    $user = (array)$_SESSION["user"];
    $userId = $user["id"];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Frontend</title>
    <link rel="stylesheet" href="../libs/css/materialize.min.css">
    <link rel="stylesheet" href="../css/toastr.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <nav class="blue-grey darken-2">
      <div class="nav-wrapper" id="logout">
        <a href="index.php" class="brand-logo">&nbsp;<img style="width: 60px; top: 4px;" src="img/icon.jpg" /></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php if (!isset($_SESSION["user"])) { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="cadastro.php">Register</a></li>
          <?php } else { ?>
            <li><a href="lobby.php">Lista dos jogos</a></li>
            <li><a href="<?php echo "profile.php?id=" . $userId; ?>">Perfil</a></li>
            <li><a v-on:click="doLogout($event)" href="#">Deslogar</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
    <br>
    <div id="app" class="container center">
