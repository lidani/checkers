<?php
  include 'connection.php';
  session_start();
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
  $cpassword = md5($_POST["cpassword"]);

  if ($password != $cpassword) {
    $_SESSION["error"] = "Senhas diferentes";
    header("Location: ../frontend/cadastro.php");
  } else {
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
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    } else {
      header("Location: ../frontend/login.php");
    }

    $stmt->close();
  }
?>
