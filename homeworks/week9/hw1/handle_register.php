<?php
require_once('conn.php');

if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) 
	{
	header('Location: register.php?errCode=1');
	die('資料不齊全');
}

$nickname = $_POST['nickname'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = sprintf("insert into squirrel_users(nickname, username, password) values('%s', '%s', '%s')",
				$nickname, $username, $password);
echo 'SQL:' . $sql . "<br>";
$result = $conn->query($sql);
	if (!$result) {
		header('Location: register.php?errCode=2');
		die ($conn->error);
	}
   	header("Location: index.php");
?>