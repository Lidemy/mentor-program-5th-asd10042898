<?php
session_start();
require_once('conn.php');
require_once('utils.php');

if (empty($_POST['content'])) 
	{
	header('Location: update_content.php?errCode=1&id='.$_POST['id']);
	die('資料不齊全');
}

$username = $_SESSION['username'];
$user = getUserFromUsername($username);
$id = $_POST['id'];
$content = $_POST['content'];

$sql = "update squirrel_comments set content=? where id=? and username=?";
if (isAdmin($user)) {
	$sql = "update squirrel_comments set content=? where id=?";
}
$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
if (isAdmin($user)) {
	$stmt->bind_param('si', $content, $id);// bind_param() 裡面第一個傳的參數是指要幾個內容, 兩個字串所以我們輸入'ss', 後面則是我們要的內容是甚麼
} else {
	$stmt->bind_param('sis', $content, $id, $username);// bind_param() 裡面第一個傳的參數是指要幾個內容, 兩個字串所以我們輸入'ss', 後面則是我們要的內容是甚麼
}

echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: index.php");
?>