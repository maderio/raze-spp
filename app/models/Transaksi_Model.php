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

  public function getAllTransaksi($sort = 'DESC')
  {
    $query = "SELECT * FROM {$this->table} ORDER BY id_transaksi {$sort}";
    return $this->db->query($query)->fetchAll();
  }

  public function getTransaksiByIdSiswa($id)
  {
    $query = "SELECT {$this->table}.*, pembayaran.nominal, pembayaran.tahun_ajaran, petugas.nama AS nama_petugas
              FROM {$this->table}
              LEFT JOIN pembayaran ON transaksi.id_pembayaran=pembayaran.id_pembayaran
              LEFT JOIN petugas ON transaksi.id_petugas=petugas.id_petugas
              WHERE transaksi.id_siswa=:id";
    return $this->db->query($query)->bind('id', $id)->fetchAll();
  }

  public function getTotalTansaksiByIdSiswa($id)
  {
    $query = "SELECT COUNT(id_transaksi) AS total_transaksi FROM {$this->table} WHERE id_siswa=:id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function getBulanDibayarByIdSiswa($id)
  {
    $query = "SELECT get_bulan_dibayar(:id)";
    $bulan = $this->db->query($query)->bind('id', $id)->fetch();
    $bulan = $bulan["get_bulan_dibayar({$id})"];
    if ($bulan !== null) {
      $bulan = explode(',', $bulan);
      return $bulan;
    }
    return [];
  }

  public function createTransaksi($data)
  {
    $year = date('Y');
    foreach ($data['bulan_dibayar'] as $month) {
      $query = "CALL create_transaksi(:bulan_dibayar, :tahun_dibayar, :id_siswa, :id_petugas, :id_pembayaran)";
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
