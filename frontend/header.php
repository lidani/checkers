<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Frontend</title>
    <link rel="stylesheet" href="../libs/css/materialize.min.css">
    <link rel="stylesheet" href="../css/toastr.min.css">
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <nav class="blue-grey darken-2">
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">&nbsp;<img style="width: 60px; top: 4px;" src="img/icon.jpg" /></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php if (!isset($_SESSION["id"])) { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="cadastro.php">Register</a></li>
          <?php } else { ?>
            <li><a href="lobby.php">Lista dos jogos</a></li>
            <li><a href="profile.php">Perfil</a></li>
            <li><a href="../backend/logout.php">Deslogar</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
    <br>
    <div id="app" class="container center">
