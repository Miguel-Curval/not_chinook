<?php
class Session
{
  private array $messages;

  public function __construct()
  {
    session_start();

    $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
    unset($_SESSION['messages']);
  }

  public function isLoggedIn(): bool
  {
    return isset($_SESSION['id']);
  }

  public function logout()
  {
    session_destroy();
  }

  public function getId(): ?int
  {
    return isset($_SESSION['id']) ? $_SESSION['id'] : null;
  }

  public function getName(): ?string
  {
    return isset($_SESSION['name']) ? $_SESSION['name'] : null;
  }

  public function setId(int $id)
  {
    $_SESSION['id'] = $id;
  }

  public function setRole(string $role)
  {
    $_SESSION['role'] = $role;
  }

  public function getRole(): ?string
  {
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
  }

  public function setName(string $name)
  {
    $_SESSION['name'] = $name;
  }

  public function addMessage(string $type, string $text)
  {
    $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
  }

  public function getMessages()
  {
    return $this->messages;
  }

  public function addDebug($var)
  {
    $_SESSION['debug'][] = $var;
  }
  public function getDebug()
  {
    return isset($_SESSION['debug']) ? $_SESSION['debug'] : null;
  }
}
