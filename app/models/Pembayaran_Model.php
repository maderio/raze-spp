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
    $this->db->query($query);
    return $this->db->fetchAll();
  }

  public function getPembayaranById($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id_pembayaran = :id";
    $this->db->query($query);
    $this->db->bind('id_pembayaran', $id);
    return $this->db->fetch();
  }

  public function createPembayaran($data)
  {
    $query = "INSERT INTO {$this->table} VALUES(NULL, :tahun_ajaran, :nominal)";
    $this->db->query($query);
    $this->db->bind('tahun_ajaran', $data['tahun_ajaran']);
    $this->db->bind('nominal', $data['nominal']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function updatePembayaran($data)
  {
    $query = "UPDATE {$this->table} SET tahun_ajaran=:tahun_ajaran, nominal=:nominal WHERE id_pembayaran = :id";
    $this->db->query($query);
    $this->db->bind('tahun_ajaran', $data['tahun_ajaran']);
    $this->db->bind('nominal', $data['nominal']);
    $this->db->bind('id', $data['id_pembayaran']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deletePembayaranById($id)
  {
    $query = "DELETE FROM {$this->table} WHERE id_pembayaran = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
