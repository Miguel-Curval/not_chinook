<?php
  declare(strict_types = 1);

  class Ticket {
    public int $id;
    public string $title;
    public string $status;
    public int $idCreator;
    public int $idAssigned;
    public string $departmentName;
    public int $priority;

    public function __construct(int $id, string $title, string $status, int $idCreator, $idAssigned, $departmentName, $priority)
    { 
      if (!$idAssigned) $idAssigned = 0;
      if (!$departmentName) $departmentName = '';
      if (!$priority) $priority = 0;
      $this->id = $id;
      $this->title = $title;
      $this->status = $status;
      $this->idCreator = $idCreator;
      $this->idAssigned = $idAssigned;
      $this->departmentName = $departmentName;
      $this->priority = $priority;

    }

    static function newTicket(PDO $db, string $title, int $idCreator) {
    try {
      $stmt = $db->prepare('
        INSERT
        INTO Ticket (title, idCreator) 
        VALUES (?, ?)
      ');

      $stmt->execute(array($title, $idCreator));
    } catch(PDOException $e) {
      die("Not unique: " . $e->getMessage());
    }
  }

    static function getTickets(PDO $db, int $count) : array {
      $stmt = $db->prepare('
        SELECT id, title, status, idCreator, idAssigned, departmentName, priority 
        FROM Ticket 
        LIMIT ?
      ');
      $stmt->execute(array($count));
  
      $tickets = array();
      while ($ticket = $stmt->fetch()) {
        $tickets[] = new Ticket(
            $ticket['id'],
            $ticket['title'],
            $ticket['status'],
            $ticket['idCreator'],
            $ticket['idAssigned'],
            $ticket['departmentName'],
            $ticket['priority']
        );
      }
  
      return $tickets;
    }

    static function searchTickets(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('
        SELECT id, title, status, idCreator, idAssigned, departmentName, priority 
        FROM Ticket 
        WHERE title 
        LIKE ? 
        LIMIT ?');
      $stmt->execute(array($search . '%', $count));
  
      $tickets = array();
      while ($ticket = $stmt->fetch()) {
        $tickets[] = new Ticket(
            $ticket['id'],
            $ticket['title'],
            $ticket['status'],
            $ticket['idCreator'],
            $ticket['idAssigned'],
            $ticket['departmentName'],
            $ticket['priority']
        );
      }
  
      return $tickets;
    }

    static function getTicket(PDO $db, int $id) : Ticket {
      $stmt = $db->prepare('
        SELECT id, title, status, idCreator, idAssigned, departmentName, priority 
        FROM Ticket 
        WHERE id = ?
      ');
      $stmt->execute(array($id));
  
      $ticket = $stmt->fetch();
  
      return new Ticket(
        $ticket['id'],
        $ticket['title'],
        $ticket['status'],
        $ticket['idCreator'],
        $ticket['idAssigned'],
        $ticket['departmentName'],
        $ticket['priority']
      );
    }

    static function getUserTickets(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT id, title, status, idCreator, idAssigned, departmentName, priority 
        WHERE idCreator = ?
      ');
      $stmt->execute(array($id));
  
      $tickets = array();
  
      while ($ticket = $stmt->fetch()) {
        $tickets[] = new Ticket(
          $ticket['id'],
          $ticket['title'],
          $ticket['status'],
          $ticket['idCreator'],
          $ticket['idAssigned'],
          $ticket['departmentName'],
          $ticket['priority']
        );
      }
  
      return $tickets;
    }

    function save(PDO $db) {
      $stmt = $db->prepare('
        UPDATE ALBUM SET Title = ?
        WHERE TicketId = ?
      ');

      $stmt->execute(array($this->title, $this->id));
    }
  
  }
?>