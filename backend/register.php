<?php
  include 'connection.php';
  session_start();

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
  $nickname = $_POST["nickname"];

  $query = "INSERT INTO `users` (id, name, email, password, nickname)
  VALUES (NULL, ?, ?, ?, ?)";
  $stmt = $mysqli->prepare($query);
  if (!$stmt) {
      die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (!$stmt->bind_param("ssss", $name, $email, $password, $nickname)) {
      die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
  }

  if (!$stmt->execute()) {
    if ($stmt->errno == 1062) {
      die("Apelido ou E-mail já cadastrados");
    } else {
      die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
  } else {
    echo json_encode("Cadastro efetuado com sucesso");
  }

  $stmt->close();
?>
