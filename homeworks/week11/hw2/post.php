<?php
session_start();
require_once("conn.php");
require_once("utils.php");

$id = intval($_GET['id']);

$stmt = $conn->prepare(
    'select '.
      'P.id as id, P.content as content, P.title as title, '.
      'P.created_at as created_at, U.nickname as nickname, U.username as username '.
    'from squirrel_posts as P '. 
    'left join squirrel_users as U on P.username = U.username '.
    'where P.id = ? ' 
  );
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if (!$result) {
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include_once("header.php") ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><?php if (isset($row['title'])) echo $row['title']; ?></div>
          <div class="post__actions">
            <?php if (!empty($_SESSION['username'])) { ?>
              <a class="post__action" href="update_post.php?id=<?php echo escape($row['id']); ?>">編輯</a>
            <?php } ?>
          </div>
        </div>
        <div class="post__info">
          <?php if (isset($row['created_at'])) echo $row['created_at']; ?>
        </div>
        <div class="post__content"><?php if (isset($row['content'])) echo $row['content']; ?>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>