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
    return $this->db->query($query)->execute()->rowCount();
  }

  public function getTransaksiByIdSiswa($id)
  {
    $query = "SELECT * FROM {$this->table} WHERE id_siswa = :id";
    return $this->db->query($query)->bind('id', $id)->fetchAll();
  }

  public function createTransaksi($data)
  {
    $year = date('Y');
    foreach ($data['bulan_dibayar'] as $month) {
      $query = "INSERT INTO {$this->table} VALUES(NULL, NOW(), :bulan_dibayar, :tahun_dibayar, :id_siswa, :id_petugas, :id_pembayaran)";
      $this->db->query($query)
        ->binds([
          'bulan_dibayar' => $month,
          'tahun_dibayar' => $year,
          'id_siswa' => $data['id_siswa'],
          'id_petugas' => $data['id_petugas'],
          'id_pembayaran' => $data['id_pembayaran'],
        ])
        ->execute();
    }
    return $this->db->rowCount();
  }
}
