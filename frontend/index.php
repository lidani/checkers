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
  <h5>Você possui <?php echo $user["victories"]; ?> vitórias e <?php echo $user["empates"] ?> empates.</h5>
  <br />
  <a class="btn blue-grey darken-2" href="newGame.php">Criar um jogo</a>
</div>

<?php include 'footer.php'; ?>
