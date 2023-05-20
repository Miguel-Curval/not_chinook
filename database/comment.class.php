<?php
  declare(strict_types = 1);

  class Comment {
    public int $id;
    public string $timestamp;
    public string $content;
    public int $idCreator;
    public int $idTicket;

    public function __construct(int $id, string $timestamp, string $content, int $idCreator, int $idTicket)
    {
      $this->id = $id;
      $this->timestamp = $timestamp;
      $this->content = $content;
      $this->idCreator = $idCreator;
      $this->idTicket = $idTicket;
    }

    static function searchComments(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('
        SELECT id, timestamp, content, idCreator, idTicket
        FROM Comment
        WHERE content 
        LIKE ? 
        LIMIT ?
      ');
      $stmt->execute(array($search . '%', $count));
  
      $comments = array();
      while ($comment = $stmt->fetch()) {
        $tickets[] = new Comment(
          $comment['id'], 
          $comment['timestamp'], 
          $comment['content'],
          $comment['idCreator'],
          $comment['idTicket']
        );
      }
  
      return $comments;
    }

    static function getComment(PDO $db, int $id) : Comment {
      $stmt = $db->prepare('
        SELECT id, timestamp, content, idCreator, idTicket
        FROM Comment
        WHERE id = ?
      ');
      $stmt->execute(array($id));
  
      $comment = $stmt->fetch();
  
      return new Comment(
        $comment['id'], 
        $comment['timestamp'], 
        $comment['content'],
        $comment['idCreator'],
        $comment['idTicket']
      );
    }

    function save(PDO $db) {
      $stmt = $db->prepare('
        UPDATE Comment SET content = ?
        WHERE id = ?
      ');

      $stmt->execute(array($this->content, $this->id));
    }

    static function getTicketComments(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT id, timestamp, content, idCreator, idTicket
        FROM Comment 
        WHERE idTicket = ?
      ');
      $stmt->execute(array($id));
  
      $comments = [];

      while ($comment = $stmt->fetch()) {
        $comments[] = new Comment(
          $comment['id'], 
          $comment['timestamp'], 
          $comment['content'],
          $comment['idCreator'],
          $comment['idTicket']
        );
      }

      return $comments;
    }
  
  }
?>
