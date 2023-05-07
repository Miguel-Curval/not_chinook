<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $name;
    public string $email;
    public string $role;
    public string $departmentName;

    public function __construct(int $id, string $username, string $name, string $email, string $role, string $departmentName) {
      $this->id = $id;
      $this->username = $username;
      $this->name = $name;
      $this->email = $email;
      $this->role = $role;
      $this->departmentName = $departmentName;
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT username, name, password, email, role, departmentName
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
        SELECT username, name, email, role, departmentName
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

  }
?>
