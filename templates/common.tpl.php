<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session)
{ ?>
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <title>IssueTracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../javascript/script.js" defer></script>
  </head>

  <body>

    <header>
      <h1><a href="/">IssueTracker</a></h1>

      <?php if ($session->isLoggedIn()) { ?>
        <h1><a href="../pages/new_ticket.php">Submit New Ticket</a></h1>
      <?php
      } ?>
      <?php
      if ($session->isLoggedIn()) drawLogoutForm($session);
      else drawLoginForm();
      ?>
    </header>

    <section id="messages">
      <?php foreach ($session->getMessages() as $message) { ?>
        <article class="<?= $message['type'] ?>">
          <?= $message['text'] ?>
        </article>
      <?php } ?>
    </section>

    <main>
    <?php } ?>

    <?php function drawFooter()
    { ?>
    </main>
    <footer>
      IssueTracker &copy; 2023
    </footer>
  </body>

  </html>
<?php } ?>

<?php function drawLoginForm()
{ ?>
  <form action="../actions/action_login.php" method="post" class="login">
    <div>
      <input type="email" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
    </div>
    <div>
      <a href="../pages/register.php">Register</a>
      <button type="submit">Login</button>
    </div>
  </form>
<?php } ?>

<?php function drawLogoutForm(Session $session)
{ ?>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <a href="../pages/profile.php"><?= $session->getName() ?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawNewTicketForm()
{ ?>
  <form action="../actions/action_new_ticket.php" method="post" class="new_ticket">
    <input type="text" name="title">
    <button type="submit">Submit New Ticket</button>
  </form>
<?php } ?>