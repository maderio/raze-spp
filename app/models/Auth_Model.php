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
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('password', $data['password']);
    return $this->db->fetch();
  }

  public function register($data)
  {
    $query  = "INSERT INTO {$this->table} VALUES(NULL, :username, :password, :role)";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('role', 3);
    $this->db->execute();
    return $this->db->rowCount();
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
    $query = "SELECT nama FROM {$user} WHERE id_{$user} = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->fetch()['nama'];
  }

  public function deletePenggunaById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_pengguna = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
