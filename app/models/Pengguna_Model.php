<?php

class Pengguna_Model
{
  private $table = 'pengguna';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getPenggunaById($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id_pengguna = :id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function getRiwayatLoginById($id)
  {
    $query = "SELECT * FROM riwayat_login WHERE id_pengguna = :id ORDER BY waktu DESC";
    return $this->db->query($query)->bind('id', $id)->fetchAll();
  }

  public function updatePengguna($data)
  {
    $query = "UPDATE {$this->table} SET username = :username, password = :password WHERE id_pengguna = :id";
    return $this->db->query($query)
      ->binds([
        'username' => $data['username'],
        'password' => $data['password'],
        'id' => $data['id_pengguna'],
      ])
      ->execute()
      ->rowCount();
  }
}
