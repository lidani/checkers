<?php
session_start();

include 'connection.php';

$user = (array)$_SESSION['user'];
$userId = $user["id"];

$res = $mysqli->query(
  "SELECT * FROM jogos WHERE player1_id=$userId OR player2_id=$userId"
);
if (!$res) {
  die("Error querying jogos table.");
}

echo json_encode($res->fetch_all());

?>
