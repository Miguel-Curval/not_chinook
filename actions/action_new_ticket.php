<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/user.class.php');


  $db = getDatabaseConnection();
  $user = User::getUser($db, $session->getId());
  
  Ticket::newTicket($db, $_POST['title'], $user->id);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>