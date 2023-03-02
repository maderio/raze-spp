<?php

class Pembayaran_Model
{
  private $table = 'pembayaran';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllPembayaran()
  {
    $query = "SELECT * FROM {$this->table}";
    return $this->db->query($query)->fetchAll();
  }

  public function getPembayaranById($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id_pembayaran = :id";
    return $this->db->query($query)->bind('id_pembayaran', $id)->fetch();
  }

  public function createPembayaran($data)
  {
    $query = "INSERT INTO {$this->table} VALUES(NULL, :tahun_ajaran, :nominal)";
    return $this->db->query($query)
      ->binds([
        'tahun_ajaran' => $data['tahun_ajaran'],
        'nominal' => $data['nominal']
      ])
      ->execute()
      ->rowCount();
  }

  public function updatePembayaran($data)
  {
    $query = "UPDATE {$this->table} SET tahun_ajaran=:tahun_ajaran, nominal=:nominal WHERE id_pembayaran = :id";
    return $this->db->query($query)
      ->binds([
        'tahun_ajaran' => $data['tahun_ajaran'],
        'nominal' => $data['nominal'],
        'id' => $data['id_pembayaran']
      ])
      ->execute()
      ->rowCount();
  }

  public function deletePembayaranById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_pembayaran = :id";
    return $this->db->query($query)->bind('id', $id)->execute()->rowCount();
  }
}
