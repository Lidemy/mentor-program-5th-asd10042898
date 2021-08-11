<?php
  session_start(); // 直接運用 PHP 的 session 機制
  require_once("conn.php");
  require_once("utils.php");

  $id = $_GET['id'];
  
  /*
    1. 從 cookie 裡面讀取 PHPSESSID(token)
    2. 從檔案裏面讀取 session id 的內容
    3. 放到 $_SESSION
  */
  $username = NULL;
  $user = NULL;
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }
  


  /* **上面部分可以直接變成
  $username = NULL;
  if (!empty($_SESSION['username'])) {
  $username = $_SESSION['username'];
  }
  他功能做了
  1.從 cookie 裡面讀取 PHPSESSID(token)
  2.從檔案裏面讀取 session id 的內容
  3.放到$_SESSION
   */
  $stmt = $conn->prepare(
    'select * from squirrel_comments where id = ?'
  );
  $stmt->bind_param("i", $id);// 因為是數字所以用 i
  $result = $stmt->execute();
  
  if (!$result) {
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  

  <title>留言板</title>
  

  <link rel="stylesheet" href="style.css">

</head>

<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
  </header>
  <main class="board">
    
    <h1 class="board__title">編輯留言</h1>
    <?php
      if (!empty($_GET['errCode'])) {
       $code = $_GET['errCode'];
       $msg = 'Error';
       if ($code === '1') {
        $msg = '資料不齊全';
       }
       echo '<h2 class="error">錯誤:' . $msg . '</h2>';
      }
    ?>
      <form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
        <textarea name="content" rows="5"><?php echo $row['content'] ?></textarea>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>" /><!--
          這行是為了讓 handle_update_comment.php 知道要去修改哪個 id 所以用這種方式帶到下個頁面 -->
        <input class="board__submit-btn" type="submit" />
      </form>
  </main>
</body>
</html>