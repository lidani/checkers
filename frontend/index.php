<?php
  session_start();
  include 'header.php';
  include '../backend/connection.php';

  if (!isset($_SESSION["id"])) {
    header("Location: login.php");
  }
?>

<div id="index">
  <h5>Seja bem vindo <?php echo $_SESSION["name"]; ?></h5>
  <br />
  <a href="../backend/logout.php">Deslogar</a>
</div>

<?php
  include 'footer.php';
?>
