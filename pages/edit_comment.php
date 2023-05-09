<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/comment.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/comment.tpl.php');

  $db = getDatabaseConnection();

  $comment = Comment::getComment($db, intval($_GET['id']));

  drawHeader($session);
  drawEditComment($comment);
  drawFooter();
?>