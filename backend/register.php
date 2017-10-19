<?php
  include 'connection.php';
  session_start();

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);

  $query = "INSERT INTO `users`(id, name, email, password) ".
    "VALUES (NULL, ?, ?, ?)";
  $stmt = $mysqli->prepare($query);
  if (!$stmt) {
      die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (!$stmt->bind_param("sss", $name, $email, $password)) {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error
      . "<br />Nome: $name");
  }

  if (!$stmt->execute()) {
    echo ("Erro ao criar conta: ". $stmt->errno);
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
  } else {
    echo json_encode("Cadastro efetuado com sucesso");
  }

  $stmt->close();
?>
