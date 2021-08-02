<?php
	/*require_once('conn.php');

	//刪除 token
	$token = $_COOKIE['token'];
	$sql = sprintf("delete from tokens where token='%s'", $token);
	$conn->query($sql);

	setcookie("token", "", time() - 3600);/* 讓過期時變成過去時間, "username" 為空字串, 便會變成登出狀態 */

	/* **上面可以只改成 */
	session_start();
	session_destroy();
	/*session_destroy();
	是用來登出後把資料清空的
	 */
	header("Location: index.php");
?>