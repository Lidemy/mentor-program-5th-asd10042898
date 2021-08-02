<?php
session_start();
require_once('conn.php');
require_once('utils.php');

if (empty($_POST['nickname'])) 
	{
	header('Location: index.php?errCode=1');
	die('資料不齊全');
}

$username = $_SESSION['username'];
$nickname = $_POST['nickname'];
$sql = "update squirrel_users set nickname=? where username=?";
$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
$stmt->bind_param('ss', $nickname, $username);// bind_param() 裡面第一個傳的參數是指要幾個內容, 兩個字串所以我們輸入'ss', 後面則是我們要的內容是甚麼
echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: index.php");
?>