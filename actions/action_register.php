<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  
  User::newUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>