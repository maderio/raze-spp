<?php

class Petugas_Model
{
  private $table  = 'petugas';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCountPetugas()
  {
    $query  = "SELECT id_petugas FROM {$this->table}";
    return $this->db->query($query)->execute()->rowCount();
  }

  public function getAllPetugas()
  {
    $query  = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna";
    return $this->db->query($query)->fetchAll();
  }

  public function getPetugasById($id)
  {
    $query = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna WHERE petugas.id_petugas = :id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function getPetugasByIdPengguna($id)
  {
    $query = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna WHERE petugas.id_pengguna = :id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function createPetugas($data)
  {
    $user = "INSERT INTO pengguna VALUES(NULL, :username, :password, :role)";
    $this->db->query($user)
      ->binds([
        'username' => $data['username'],
        'password' => md5($data['password'] . SALT),
        'role' => 2,
      ])
      ->execute();
    $id_pengguna = $this->db->lastInsertId();
    if ($this->db->rowCount() > 0) {
      $staff = "INSERT INTO {$this->table} VALUES(NULL, :nama, :id)";
      return $this->db->query($staff)
        ->binds([
          'nama' => $data['nama'],
          'id' => $id_pengguna
        ])
        ->execute()
        ->rowCount();
    } else {
      return 0;
    }
  }

  public function updatePetugas($data)
  {
    $query = "UPDATE {$this->table} SET nama = :nama WHERE id_petugas = :id";
    return $this->db->query($query)
      ->binds([
        'nama' => $data['nama'],
        'id' => $data['id_petugas']
      ])
      ->execute()
      ->rowCount();
  }
}
