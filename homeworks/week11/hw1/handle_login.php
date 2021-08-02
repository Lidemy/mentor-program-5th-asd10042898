<?php
session_start(); //直接運用 PHP 的 session 機制
require_once('conn.php');
require_once('utils.php');

if (empty($_POST['username']) || empty($_POST['password'])) 
	{
	header('Location: login.php?errCode=1');
	die('資料不齊全');
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from squirrel_users where username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);	
echo 'SQL:' . $sql . "<br>";
$result = $stmt->execute();// 主要這行是看有沒有執行成功
if (!$result) {
	die($conn->error);
}

$result = $stmt->get_result();// 要把結果拿回來所以要加這行
//沒查到使用者
if ($result->num_rows === 0) {
	header("Location: login.php?errCode=2");
	exit();// 打這個是為了在沒有查到使用者時離開, 避免執行到下面的程式碼
}
//有查到使用者, password_verify() 是用來比對輸入的 $password 跟 資料庫裡的 $row['password'] 是否一樣
$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
	// 建立 token 並儲存
	/*$token = generateToken();
	$sql = sprintf(
		"insert into tokens(token, username) values('%s', '%s')", $token, $username);
	$result = $conn->query($sql);
	if (!$result) {
		die ($conn->error);
	}
	// 登入成功
	$expire = time() + 3600 *24 *30; // 30 day, time() 代表現在當下時間
	setcookie("token", $token, $expire);/* 設定 cookie 可以讓 server 去判斷是否是登入的帳號, 後面的 $expire 是用來設定 cookie 過期時限的 */
    $_SESSION['username'] = $username;
	/* ** 登入成功部分, 可以使用 $_SESSION['username'] = $username; 代替 
	他做的功能有
	1.產生 session id (token)
	2.把 username 寫入檔案
	3.set-cookie: session-id
	*/
	
	header("Location: index.php");
} else {
	header("Location: login.php?errCode=2");
}
   	
?>