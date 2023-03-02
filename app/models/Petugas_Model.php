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
    $this->db->query($query);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllPetugas()
  {
    $query  = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna";
    $this->db->query($query);
    return $this->db->fetchAll();
  }

  public function getPetugasById($id)
  {
    $query = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna WHERE petugas.id_petugas = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->fetch();
  }

  public function getPetugasByIdPengguna($id)
  {
    $query = "SELECT petugas.*, pengguna.* FROM {$this->table} LEFT JOIN pengguna ON petugas.id_pengguna = pengguna.id_pengguna WHERE petugas.id_pengguna = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->fetch();
  }

  public function createPetugas($data)
  {
    $user = "INSERT INTO pengguna VALUES(NULL, :username, :password, :role)";
    $this->db->query($user);
    $this->db->bind('username', $data['username']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('role', 2);
    $this->db->execute();
    $id_pengguna = $this->db->lastInsertId();
    if ($this->db->rowCount() > 0) {
      $staff = "INSERT INTO {$this->table} VALUES(NULL, :nama, :id)";
      $this->db->query($staff);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('id', $id_pengguna);
      $this->db->execute();
      return $this->db->rowCount();
    } else {
      return 0;
    }
  }

  public function updatePetugas($data)
  {
    $query = "UPDATE {$this->table} SET nama = :nama WHERE id_petugas = :id";
    $this->db->query($query);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('id', $data['id_petugas']);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
