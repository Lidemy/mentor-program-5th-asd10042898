<?php
session_start();
require_once('conn.php');
require_once('utils.php');


if (empty($_GET['id'])) 
	{
	header('Location: index.php?errCode=1');
	die('資料不齊全');
}

$id = $_GET['id'];
$sql = "update squirrel_comments set is_deleted=1 where id=?";

$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
// 老師是使用 soft delete 的方式來表示資料刪除
// 如果是直接使用 delete 的方式叫做 hard delete
$stmt->bind_param('i', $id);

$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: index.php");
?>