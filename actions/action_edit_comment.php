<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/comment.class.php');

  if (trim($_POST['content']) === '') {
    $session->addMessage('error', 'Comment content cannot be empty');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $db = getDatabaseConnection();

  $comment = Comment::getComment($db, intval($_POST['id']));

  if ($comment) {
    $comment->content = $_POST['content'];
    $comment->save($db);
    $session->addMessage('success', 'Comment content updated');
    header('Location: ../pages/ticket.php?id=' . $comment->idTicket);
  } else {
    $session->addMessage('error', 'Comment does not exist');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>