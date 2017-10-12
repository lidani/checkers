<?php session_start();
if (!array_key_exists("id", $_SESSION)) {
	header("Location: index.php");
	die();
}

include '../backend/connection.php';

$userId = $_SESSION['id'];
$res = $mysqli->query(
  "SELECT * FROM jogos WHERE jogador1_id=$userId OR jogador2_id=$userId"
);
if (!$res) {
  die("Error querying jogos table.");
}
$jogos = $res->fetch_all();

echo json_encode($jogos);

?>
