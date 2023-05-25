<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/ticket.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  if ($user->role == 'agent') {
    $ticket = Ticket::getTicket($db, intval($_POST['ticketId']));
    $ticket->close($db);
  }

  header('Location: ../pages/ticket.php?id=' . $_POST['ticketId']);
?>