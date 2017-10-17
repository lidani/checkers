<?php
  session_start();
  include 'header.php';

  if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    die();
  }
?>

<div id="index">
  <h5>Seja bem vindo <?php echo $_SESSION["name"]; ?></h5>
  <h5>Você possui <?php echo $_SESSION["victories"] ?> vitórias e <?php echo $_SESSION["empates"] ?> empates.</h5>
  <br />
  <a class="btn blue-grey darken-2" href="lobby.php">Lista de jogos</a>
</div>

<?php
  include 'footer.php';
?>
