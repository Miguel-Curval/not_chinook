<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/ticket.class.php');

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');

$db = getDatabaseConnection();

drawHeader($session);

if ($session->isLoggedIn()) {

  if ($session->getRole() == "client") {
    $tickets = Ticket::getUserTickets($db, $session->getId());
    drawTickets($tickets);
  }

  if ($session->getRole() == "agent") {
    $tickets = Ticket::getTickets($db, $session->getId());
    drawTickets($tickets);
  }
} else { ?>
  <h3> Please login to see your tickets </h3>
<?php }

drawFooter();
?>