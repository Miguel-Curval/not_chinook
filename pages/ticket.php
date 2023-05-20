<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/comment.class.php');
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');

  $db = getDatabaseConnection();

  $ticket = Ticket::getTicket($db, intval($_GET['id']));
  $user = User::getUser($db, $ticket->idCreator);
  $comments = Comment::getTicketComments($db, intval($_GET['id']));

  drawHeader($session);
  drawTicket($ticket, $user, $comments);
  drawFooter();
?>