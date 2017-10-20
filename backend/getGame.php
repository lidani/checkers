<?php
	session_start();
	
	include 'connection.php';

	$id = $_GET['id'];
	$res = $mysqli->query(
	  "SELECT * FROM `jogos` WHERE `id`='$id'"
	);
	if (!$res) {
	  die($mysqli->error);
	}

	echo json_encode($res->fetch_all());

?>
