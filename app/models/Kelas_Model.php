<?php

class Kelas_Model
{
  private $table = 'kelas';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCountKelas()
  {
    $query = "SELECT id_kelas FROM {$this->table}";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllKelas()
  {
    $query = "SELECT * FROM {$this->table}";
    $this->db->query($query);
    return $this->db->fetchAll();
  }

  public function createKelas($data)
  {
    $query = "INSERT INTO {$this->table} VALUES(NULL, :nama, :kompetensi_keahlian)";
    $this->db->query($query);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('kompetensi_keahlian', $data['kompetensi_keahlian']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function updateKelas($data)
  {
    $query = "UPDATE {$this->table} SET nama=:nama, kompetensi_keahlian=:kompetensi_keahlian WHERE id_kelas=:id";
    $this->db->query($query);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('kompetensi_keahlian', $data['kompetensi_keahlian']);
    $this->db->bind('id', $data['id_kelas']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteKelasById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_kelas = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
