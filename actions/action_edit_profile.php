<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  if ($user) {
    $user->username = $_POST['username'];
    $user->name = $_POST['name'];
    $user->email = strtolower($_POST['email']);
    
    $user->save($db);

    if (!empty($_POST['password']) and $_POST['password'] == $_POST['repeat_password']) {
      $user->updatePassword($db, $_POST['password']);
    }

    $session->setName($user->username);
  }

  header('Location: ../pages/profile.php');
?>