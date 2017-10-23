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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libs/css/materialize.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div id="logout">
    <nav class="blue-grey darken-2">
      <div class="nav-wrapper">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php if (!isset($_SESSION["user"])) { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="cadastro.php">Register</a></li>
          <?php } else { ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="lobby.php">Lista dos jogos</a></li>
            <li><a href="<?php echo "profile.php?id=" . $userId; ?>">Perfil</a></li>
            <li><a v-on:click="doLogout($event)" href="#">Deslogar</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
    <ul id="slide-out" class="side-nav mobile">
      <?php if (isset($_SESSION["user"])) { ?>
        <li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
        <li><a href="lobby.php"><i class="material-icons">playlist_add_check</i>Lista dos jogos</a></li>
        <li><a href="<?php echo "profile.php?id=" . $userId; ?>"><i class="material-icons">person</i>Perfil</a></li>
        <li id="logout"><a v-on:click="doLogout($event)" href="#"><i class="material-icons">power_settings_new</i>Logout</a></li>
      <?php } else { ?>
        <li><a href="login.php"><i class="material-icons">access_time</i>Login</a></li>
        <li><a href="cadastro.php"><i class="material-icons">person_add</i>Register</a></li>
    <?php } ?>
  </ul>
</div>
    <br>
    <div id="app" class="container center">
