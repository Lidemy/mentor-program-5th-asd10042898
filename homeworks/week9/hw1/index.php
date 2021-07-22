<?php
  require_once("conn.php");
  require_once("token.php");
  
  $username = NULL;
  if (!empty($_COOKIE['token'])) {
    $user = getUserFromToken($_COOKIE['token']);
    $username = $user['username'];
  }

  $result = $conn->query("select * from squirrel_comments order by id desc");
  if(!$result) {
    die('Error' . $conn->error);
  }/* 設定去抓取 db 的資料, 並做如果沒有抓到的錯誤顯示 */
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong><!--這個 strong 是可以用來直接變粗體字的標籤-->
  </header>
  <main class="board">
    
    <div>
      <?php if (!$username) { ?>
        <a class="board_btn" href="register.php">註冊</a>
        <a class="board_btn" href="login.php">登入</a><!--要用超連結所以標籤是 a -->
      <?php } else {?>
        <a class="board_btn" href="logout.php">登出</a>
      <?php } ?>
    </div>
    
    <h1 class="board_title">Comment</h1>
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
    <form class="board__new-comment-form" method="POST" action="handle_add_comments.php">
      <textarea name="content" rows="5"></textarea><!--textarea 可以直接給一個輸入字的空間-->
      <?php if ($username) { ?>
        <input type="submit" class="board_submit-btn" />
      <?php } else { ?>
        <h3>請登入發布留言</h3>
      <?php } ?>
    </form>
    <div class="board_line"></div>
    <section>
      <?php
        while($row = $result->fetch_assoc()) {
      ?>
        <div class="comments">
          <div class="comments__avatar"></div>
          <div class="comments__body">
            <div class="comments__info">
              <span class="comments__author">
                <?php echo $row['nickname'] ?>
              </span><!-- 使用 span 不會像 div 一樣兩個標籤是上下並排, 而是左右並排-->
              <span class="comments__time">
                <?php echo $row['create_at'] ?>
              </span>
            </div>
            <p class="comments__content"><?php echo $row['content'] ?></p><!-- p 會自帶上下 margin -->
          </div>
        </div>
      <?php } ?>
    </section>
  </main>
</body>
</html>