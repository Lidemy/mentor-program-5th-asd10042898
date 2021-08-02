<?php
session_start();
require_once('conn.php');
require_once('utils.php');

if (empty($_POST['content']) || empty($_POST['title'])) 
	{
	header('Location: create_post.php?errCode=1');
	die('資料不齊全');
}
$username = $_SESSION['username'];
$user = getUserFromUsername($username);


$content = $_POST['content'];
$title = $_POST['title'];
$sql = "insert into squirrel_posts(username, content, title) values(?, ?, ?)";
$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
$stmt->bind_param('sss', $username, $content, $title);// bind_param() 裡面第一個傳的參數是指要幾個內容, 兩個字串所以我們輸入'ss', 後面則是我們要的內容是甚麼
echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: admin.php");
?>