<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) die(header('Location: /'));

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/comment.class.php');

$db = getDatabaseConnection();

if ($_POST['comment'] && $_POST['ticketId']) {
    Comment::addComment($db, $session->getId(), $_POST['ticketId'], $_POST['comment']);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
