<?php
session_start();
require_once('conn.php');
require_once('utils.php');

if (empty($_GET['id']) || empty($_GET['role'])) 
	{
	die('資料不齊全');
}

$username = $_SESSION['username'];
$user = getUserFromUsername($username);
$id = $_GET['id'];
$role = $_GET['role'];

if (!$user || $user['role'] !== 'ADMIN') {
	header('Location: admin.php');
	exit;
}

$sql = "update squirrel_users set role=? where id=?";
$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
$stmt->bind_param('si', $role, $id);// bind_param() 裡面第一個傳的參數是指要幾個內容, 兩個字串所以我們輸入'ss', 後面則是我們要的內容是甚麼

echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: admin.php");
?>