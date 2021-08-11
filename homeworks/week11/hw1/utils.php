<?php
  require_once("conn.php");

	function generateToken() { /* 這是用來隨機產生亂數, chr(rand(65,90)) 是可以把 65-90 的數字轉換成字母 */
    $s = '';
    for($i=1; $i<=16; $i++) {
      $s .= chr(rand(65,90));
    }
    return $s;
  }

  function getUserFromUsername($username) {
    global $conn; /* 在 function 當中要使用 $conn 時要先打這行才能使用 */

    $sql = sprintf("select * from squirrel_users where username = '%s'", $username);
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;// $row 是從 username 來的, 所以會有 username, id, nickname
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
  //$action 會有 update, create, delete
  function hasPermission($user, $action, $comment) {// 用來控制權限的function
    if (!empty($user)) {// 這行是為了解決 Trying to access array offset on value of type null in 這個問題, 這是 PHP 新版本出現的問題, 沒有這行在沒登入時會跑出錯誤
      if ($user["role"] === "ADMIN") {
        return true;
      }

      if ($user["role"] === 'NORMAL') {
        if ($action === 'create') return true;// 因為 NORMAL 的使用者都會有 create 的權限, 這行是阻擋沒有 create 的使用這去跑下面的 return $comment['username'] === $user['username'];
        return $comment['username'] === $user['username'];
      }

      if ($user['role'] === 'BANNED') {
        if ($action === 'create') {
          return false;
          exit;
        } else if ($action === 'update') {
          return $comment['username'] === $user['username'];
        }
      }
    }
  }

  function isAdmin($user) {
    return $user['role'] === 'ADMIN';
  }
?>