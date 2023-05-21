<?php

declare(strict_types=1);

require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/user.class.php');


function getUserNameById($id)
{
  $db = getDatabaseConnection();
  return User::getUser($db, $id)->name;
}
?>

<?php function drawTickets(array $tickets)
{ ?>
  <content>
    <header>
      <h2>Agent Tickets Overview</h2>
      <input id="searchticket" type="text" placeholder="search">
    </header>
    <section id="tickets">
      <?php foreach ($tickets as $ticket) { ?>
        <article id="ticket">
          <h2>ID: <?= $ticket->id ?></h2>
          <a href="../pages/ticket.php?id=<?= $ticket->id ?>"><?= $ticket->title ?></a>
        </article>
      <?php } ?>
    </section>
  </content>
<?php } ?>

<?php function drawTicket(Ticket $ticket, User $user, array $comments)
{ ?>
  <article class="ticket">
    <div class="ticket_header">
      <h2>Ticket ID Nº: <?= $ticket->id ?></h2>
      <a href="../pages/profile.php?id=<?= $ticket->idCreator ?>">
        <h2>User: <?= getUserNameById($ticket->idCreator) ?></h2>
      </a>
      <h2>Status: <?= $ticket->status ?></h2>
    </div>
    <div class="ticket_description">
      <h3>Description:</h3>
      <h3><?= $ticket->title ?></h3>
    </div>
  </article>

  <section id="comments">
    <?php foreach ($comments as $comment) { ?>
      <article class="comment">
        <a href="../pages/profile.php?id=<?= $comment->idCreator ?>"><?= getUserNameById($comment->idCreator) ?></a>
        <h3 href="../pages/comment.php?id=<?= $comment->id ?>"><?= $comment->content ?></h3>
      </article>
    <?php } ?>
    <form class="add_comment" action="action_add_comment.php" method="post">
      <input type="text" name="comment" placeholder="Add a comment...">
      <button type="submit">Send</button>
    </form>
    </div>
  </section>
<?php } ?>

<?php function drawEditTicket(Ticket $ticket)
{ ?>
  <form action="../actions/action_edit_ticket.php" method="post">
    <input type="hidden" name="id" value="<?= $ticket->id ?>">
    <label>Content:</label>
    <input type="text" name="content" value="<?= $ticket->title ?>">
    <button type="submit">Save</button>
  </form>
<?php } ?>