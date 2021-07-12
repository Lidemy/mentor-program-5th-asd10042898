<?php
	require_once('conn.php');
	$token = $_COOKIE['token'];
	$sql = sprintf("delete from squirrel_tokens where token='%s'", $token);
	$conn->query($sql);
	setcookie("token", $token, time() - 3600);
	header("Location: index.php");
?>