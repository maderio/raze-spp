<?php

class Auth_Model
{
  private $table  = 'pengguna';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($data)
  {
    $query  = "SELECT * FROM {$this->table} WHERE username = :username AND password = :password";
    return $this->db->query($query)
      ->binds([
        'username' => $data['username'],
        'password' => md5($data['password'] . SALT)
      ])
      ->fetch();
  }

  public function register($data)
  {
    $query  = "INSERT INTO {$this->table} VALUES(NULL, :username, :password, :role)";
    return $this->db->query($query)
      ->binds([
        'username' => $data['username'],
        'password' => md5($data['password'] . SALT),
        'role'  => 3
      ])
      ->execute()
      ->rowCount();
  }

  public function getPenggunaByCookie($cookie)
  {
    $query = "SELECT * FROM {$this->table} WHERE cookie = :cookie";
    return $this->db->bind('cookie', $cookie)->fetch();
  }

  public function getNamaPenggunaByRoleAndId($role, $id)
  {
    switch ($role) {
      case 1:
        $user = 'petugas';
        break;
      case 2:
        $user = 'petugas';
        break;
      default:
        $user = 'siswa';
        break;
    }
    $query = "SELECT nama FROM {$user} WHERE id_pengguna = :id";
    return $this->db->query($query)->bind('id', $id)->fetch()['nama'];
  }

  public function setUserSession($data)
  {
    unset($_SESSION['user']);
    $_SESSION['user'] = [
      'id'        => $data['id_pengguna'],
      'name'      => $this->getNamaPenggunaByRoleAndId($data['role'], $data['id_pengguna']),
      'username'  => $data['username'],
      'role'      => $data['role'],
    ];
  }

  public function setUserCookie($data)
  {
    $cookie = md5($data['username'] . SALT . time());
    setcookie('user', $cookie, time() + 3600, '/');
    $query = "UPDATE {$this->table} SET cookie = :cookie WHERE id_pengguna = :id";
    return $this->db->query($query)
      ->binds([
        'cookie' => $cookie,
        'id'  => $data['id_pengguna']
      ])
      ->execute()
      ->rowCount();
  }

  public function deletePenggunaById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_pengguna = :id";
    return $this->db->query($query)->bind('id', $id)->execute()->rowCount();
  }
}
