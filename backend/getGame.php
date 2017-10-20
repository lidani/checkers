<?php session_start();
if (!array_key_exists("user", $_SESSION)) {
	header("Location: index.php");
	die();
}

include '../backend/connection.php';

$id = $_GET['id'];
$res = $mysqli->query(
  "SELECT * FROM `jogos` WHERE `id`='$id'"
);
if (!$res) {
  die("Error querying jogos table.");
}
$jogos = $res->fetch_all();

echo json_encode($jogos);

?>
