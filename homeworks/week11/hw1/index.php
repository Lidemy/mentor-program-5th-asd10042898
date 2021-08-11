<?php
  session_start(); // 直接運用 PHP 的 session 機制
  require_once("conn.php");
  require_once("utils.php");
  
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

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);// intval() 可以把資料轉成數字型態
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;
  $stmt = $conn->prepare(
    'select '.
      'C.id as id, C.content as content, '.
      'C.create_at as create_at, U.nickname as nickname, U.username as username '.
    'from squirrel_comments as C '. 
    'left join squirrel_users as U on C.username = U.username '.
    'where C.is_deleted IS NULL '. // 用來先把 is_deleted 是 NULL 的列出來, 用來達到 soft delete 的效果
    'order by C.id desc '. 
    'limit ? offset ? '
  );//left join 是讓我們用交集的方式去選擇我們更改暱稱後的部分
   //comments as C 的意思是 comments 用 C 來取代, 所以看到 C.id 的意思是 comments.id\
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();
  
  if (!$result) {
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();
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
    
    <div>
      <?php if (!$username) { ?>
        <a class="board__btn" href="register.php">註冊</a>
        <a class="board__btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board__btn" href="logout.php">登出</a>
        <span class="board__btn update-nickname">編輯暱稱</span>
        <?php if ($user && $user['role'] === 'ADMIN') { ?>
          <a class="board__btn" href="admin.php">後臺管理</a>
        <?php } ?>
        <form class="hide board__nickname-form board__new-comment-form" method="POST" action="update_user.php">
          <div class="borad__nickname">
            <span>新的暱稱：</span>
            <input type="text" name="nickname" />
          </div>
          <input class="board__submit-btn" type="submit" />
        </form>
        <h3>你好！<?php echo $user['nickname']; ?> </h3>
      <?php } ?>
    </div>
    
    <h1 class="board__title">Comments</h1>
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
      <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
        <textarea name="content" rows="5"></textarea>
        <?php if ($username && !hasPermission($user, 'create', NULL)) { ?>
          <h3>你已被停權</h3>
        <?php } else if ($username) { ?>
          <input class="board__submit-btn" type="submit" />
        <?php } else { ?>
          <h3>請登入發布留言</h3>
        <?php } ?>
      </form>
    <div class="board__hr"></div>
    <section>
      <?php
        while($row = $result->fetch_assoc()) {
      ?>
        <div class="card">
          <div class="card__avatar"></div>
          <div class="card__body">
            <div class="card__info">
              <span class="card__author">
                <?php echo escape($row['nickname']) ?>
                (@<?php echo escape($row['username']) ?>)
              </span>
              <span class="card__time">
                <?php echo escape($row['create_at']) ?>
              </span>
              <?php if (hasPermission($user, 'update', $row)) {?>
                <a href="update_comment.php?id=<?php echo $row['id']?>">編輯</a>
                <a href="delete_comment.php?id=<?php echo $row['id']?>">刪除</a>
              <?php } ?>
            </div>
            <p class="card__content"><?php echo escape($row['content']) ?></p>
          </div>
        </div>
      <?php } ?>
    </section>
    <div class="board__hr"></div>
    <?php
      $stmt = $conn->prepare(
        'select count(id) as count from squirrel_comments where is_deleted IS NULL'//count(id) 是指算出有 id 的列有幾個
      );
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = intval(ceil($count / $items_per_page));// 算總共有幾個分頁, ceil 是無條件進位的函式
    ?>
    <div class="page_info">
      <span>總共有 <?php echo $count ?> 筆資料, 頁數 : </span>
      <span><?php echo $page ?> / <?php echo $total_page ?></span>
      分頁
    </div>
    <div class="paginator">
      <?php if ($page !== 1) { ?><!-- 要注意這個地方資料形態要轉成數字才能比較 -->
        <a href="index.php?page=1">首頁</a>
        <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
      <?php } ?>
      <?php if ($page !== $total_page) { ?>
        <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
        <a href="index.php?page=<?php echo $total_page ?>">最末頁</a>
      <?php } ?>
    </div>
  </main>
  <script>
    var btn = document.querySelector('.update-nickname')
    btn.addEventListener('click', function() {
      var form = document.querySelector('.board__nickname-form')
      form.classList.toggle('hide')// 讓編輯暱稱的按鈕可以按一下顯示表單跟按一下收起表單
    })
  </script>
</body>
</html>