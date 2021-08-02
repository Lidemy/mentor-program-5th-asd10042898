<?php
session_start();
require_once('conn.php');
require_once('utils.php');
require_once("check_permission.php");

$page = $_POST['page'];

if (empty($_POST['id']) || empty($_POST['content']) || empty($_POST['title'])) 
	{
	header("Location: " . $page);//$_SERVER['HTTP_REFERER'] 是導回上一頁
	die('資料不齊全');
}

$id = $_POST['id'];
$content = $_POST['content'];
$title = $_POST['title'];
$sql = "update squirrel_posts set title=?, content=? where id=?";

$stmt = $conn->prepare($sql);//	stmt 是 statement 簡寫
// 老師是使用 soft delete 的方式來表示資料刪除
// 如果是直接使用 delete 的方式叫做 hard delete
$stmt->bind_param('ssi', $title, $content, $id);
$result = $stmt->execute();
	if (!$result) {
		die ($conn->error);
	}
   	header("Location: " . $page);
?>