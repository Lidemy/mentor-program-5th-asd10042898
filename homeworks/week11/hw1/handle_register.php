<?php
session_start();
require_once('conn.php');

if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) 
	{
	header('Location: register.php?errCode=1');
	die('資料不齊全');
}

$nickname = $_POST['nickname'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);/* 使用 hash (雜湊) 來讓密碼不是用明碼儲存 */

$sql = "insert into squirrel_users(nickname, username, password) values(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $nickname, $username, $password);
echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();
	if (!$result) {
		$code = $conn->errno;
		if ($code === 1062) {
			header('Location: register.php?errCode=2');/* 這部分老師是用資料重複錯誤的 error code 代號 1062 去檢查錯誤 */
		}
		die ($conn->error);
	}

	$_SESSION['username'] = $username;// 直接讓註冊完一起登入的方式
   	header("Location: index.php");
?>