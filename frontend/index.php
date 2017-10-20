<?php
  session_start();
  include 'header.php';

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    die();
  }
  $user = (array)$_SESSION["user"];
?>

<div>
  <h5>Seja bem vindo <?php echo $user["name"]; ?></h5>
  <h5>Você possui <?php echo $user["victories"]; ?> vitórias.</h5>
  <br />
  <a class="btn blue-grey darken-2" href="newGame.php">Criar um jogo</a>
  <a class="btn blue-grey darken-2" href="lobby.php">Lista de jogos</a>
</div>

<?php include 'footer.php'; ?>
