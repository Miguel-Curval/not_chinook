<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $name;
    public string $email;
    public string $role;
    public string $departmentName;

    public function __construct(int $id, string $username, string $name, string $email, string $role, $departmentName) {
      $this->id = $id;
      $this->username = $username;
      $this->name = $name;
      $this->email = strtolower($email);
      $this->role = $role;
      if (!$departmentName) $departmentName = '';
      $this->departmentName = $departmentName;
    }

    static function newUser(PDO $db, $username, $name, $email, $password) {
      try {
        $stmt = $db->prepare('
          INSERT
          INTO User (username, name, email, password) 
          VALUES (?, ?, ?, ?)
        ');

        $stmt->execute(array($username, $name, $email, sha1($password)));
      } catch(PDOException $e) {
        die("Not unique: " . $e->getMessage());
    }
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ? User {
      $stmt = $db->prepare('
        SELECT id, username, name, password, email, role, departmentName
        FROM User 
        WHERE lower(email) = ? AND password = ?
      ');

      $stmt->execute(array(strtolower($email), sha1($password)));
  
      if ($user = $stmt->fetch()) {
        return new User(
          $user['id'],
          $user['username'],
          $user['name'],
          $user['email'],
          $user['role'],
          $user['departmentName']
        );
      } else return null;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT id, username, name, email, role, departmentName
        FROM User 
        WHERE id = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User(
        $user['id'],
        $user['username'],
        $user['name'],
        $user['email'],
        $user['role'],
        $user['departmentName']
      );
    }

    function save(PDO $db) {
      $stmt = $db->prepare('
        UPDATE User SET username = ?, name = ?, email = ?
        WHERE id = ?
      ');

      $stmt->execute(array($this->username, $this->name, strtolower($this->email), $this->id));
    }

    function updatePassword(PDO $db, string $password) {
      $stmt = $db->prepare('
        UPDATE User SET password = ?
        WHERE id = ?
      ');

      $stmt->execute(array(sha1($password), $this->id));
    }
  }
?>
