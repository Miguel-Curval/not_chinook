<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/ticket.class.php')
?>

<?php function drawTickets(array $tickets) { ?>
  <header>
    <h2>Tickets</h2>
    <input id="searchticket" type="text" placeholder="search">
  </header>
  <section id="tickets">
    <?php foreach($tickets as $ticket) { ?> 
      <article>
        <img src="https://picsum.photos/200?<?=$ticket->id?>">
        <a href="../pages/ticket.php?id=<?=$ticket->id?>"><?=$ticket->title?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawTicket(Ticket $ticket, User $user, array $comments) { ?>
  <h2><?=$ticket->id?></h2>
  <section id="comments">
    <?php foreach ($comments as $comment) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$comment->id?>">
      <a href="../pages/profile.php?id=<?=$comment->id?>"><?=$comment->content?></a>
      <a href="../pages/comment.php?id=<?=$comment->id?>"><?=$comment->content?></a>
      <p class="info"><?=$comment->tracks?> tracks / <?=$comment->length?> min</p>
    </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawEditTicket(Ticket $ticket) { ?>
  <form action="../actions/action_edit_ticket.php" method="post">
    <input type="hidden" name="id" value="<?=$ticket->id?>">
    <label>Content:</label>
    <input type="text" name="content" value="<?=$ticket->title?>">
    <button type="submit">Save</button>
  </form>
<?php } ?>