<?php
session_start();
require_once("conn.php");
require_once("utils.php");

if (empty($_POST['username']) || empty($_POST['password'])) {
	header('Location: login.php?errCode=1');
	die('資料不齊全');
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from squirrel_users where username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$result = $stmt->execute();
if (!$result) {
	die($conn->error);
}


$result = $stmt->get_result();
if ($result->num_rows === 0) {
	header("Location: login.php?errCode=2");
	exit();// 打這個是為了在沒有查到使用者時離開, 避免執行到下面的程式碼
}

$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
	$_SESSION['username'] = $username;
	header("Location: index.php");
} else {
	header("Locaction: login.php?errCode=2");
}
?>