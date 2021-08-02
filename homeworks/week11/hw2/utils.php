<?php
  require_once("conn.php");

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

?>