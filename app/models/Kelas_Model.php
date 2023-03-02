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
    return $this->db->query($query)->execute()->rowCount();
  }

  public function getAllKelas()
  {
    $query = "SELECT * FROM {$this->table}";
    return $this->db->query($query)->fetchAll();
  }

  public function createKelas($data)
  {
    $query = "INSERT INTO {$this->table} VALUES(NULL, :nama, :kompetensi_keahlian)";
    return $this->db->query($query)
      ->binds([
        'nama' => $data['nama'],
        'kompetensi_keahlian' => $data['kompetensi_keahlian']
      ])
      ->execute()
      ->rowCount();
  }

  public function updateKelas($data)
  {
    $query = "UPDATE {$this->table} SET nama=:nama, kompetensi_keahlian=:kompetensi_keahlian WHERE id_kelas=:id";
    return $this->db->query($query)
      ->binds([
        'nama' => $data['nama'],
        'kompetensi_keahlian' => $data['kompetensi_keahlian'],
        'id' => $data['id_kelas']
      ])
      ->execute()
      ->rowCount();
  }

  public function deleteKelasById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_kelas = :id";
    return $this->db->query($query)->bind('id', $id)->execute()->rowCount();
  }
}
