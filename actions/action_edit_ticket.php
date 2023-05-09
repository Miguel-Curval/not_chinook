<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');

  if (trim($_POST['title']) === '') {
    $session->addMessage('error', 'Ticket title cannot be empty');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $db = getDatabaseConnection();

  $ticket = Ticket::getTicket($db, intval($_POST['id']));

  if ($ticket) {
    $ticket->title = $_POST['title'];
    $ticket->save($db);
    $session->addMessage('success', 'Ticket title updated');
    header('Location: ../pages/ticket.php?id=' . $_POST['id']);
  } else {
    $session->addMessage('error', 'Ticket does not exist');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>