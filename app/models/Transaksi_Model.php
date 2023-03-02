<?php

class Transaksi_Model
{
  private $table = 'transaksi';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCountTransaksi()
  {
    $query  = "SELECT id_transaksi FROM {$this->table}";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getTransaksiByIdSiswa($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id_siswa = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->fetchAll();
  }

  public function createTransaksi($data)
  {
    $year = date('Y');
    foreach ($data['bulan_dibayar'] as $month) {
      $query = "INSERT INTO {$this->table} VALUES(NULL, NOW(), :bulan_dibayar, :tahun_dibayar, :id_siswa, :id_petugas, :id_pembayaran)";
      $this->db->query($query);
      $this->db->bind('bulan_dibayar', $month);
      $this->db->bind('tahun_dibayar', $year);
      $this->db->bind('id_siswa', $data['id_siswa']);
      $this->db->bind('id_petugas', $data['id_petugas']);
      $this->db->bind('id_pembayaran', $data['id_pembayaran']);
      $this->db->execute();
    }
    return $this->db->rowCount();
  }
}
