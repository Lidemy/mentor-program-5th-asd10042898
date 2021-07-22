<?php
require_once("conn.php");
require_once("token.php");

if(empty($_POST['content'])) {
	header('Location: index.php?errCode=1');
	die('資料不齊全');
}

$user = getUserFromToken($_COOKIE['token']);
$nickname = $user['nickname'];

$content = $_POST['content'];

$sql = sprintf("insert into squirrel_comments(nickname, content) values('%s', '%s')", $nickname, $content);

echo 'SQL:' . $sql . "<br>";
$result = $conn->query($sql);
	if(!$result) {
		die($conn->err);
	}
	header("Location: index.php");
?>