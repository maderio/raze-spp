<?php

class Siswa_Model
{
  private $table = 'siswa';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCountSiswa()
  {
    $query  = "SELECT id_siswa FROM {$this->table}";
    return $this->db->query($query)->execute()->rowCount();
  }

  public function getAllSiswa()
  {
    $query  = "SELECT siswa.*, pengguna.*, pembayaran.*, kelas.nama as nama_kelas, kelas.kompetensi_keahlian
               FROM {$this->table}
               LEFT JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
               LEFT JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
               LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
    return $this->db->query($query)->fetchAll();
  }

  public function getSiswaById($id)
  {
    $query  = "SELECT siswa.*, pengguna.*, pembayaran.*, kelas.nama as nama_kelas, kelas.kompetensi_keahlian
               FROM {$this->table}
               LEFT JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
               LEFT JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
               LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
               WHERE siswa.id_siswa = :id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function getSiswaByIdPengguna($id)
  {
    $query = "SELECT siswa.*, pengguna.*, pembayaran.*, kelas.nama as nama_kelas, kelas.kompetensi_keahlian
               FROM {$this->table}
               LEFT JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
               LEFT JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
               LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
               WHERE pengguna.id_pengguna = :id";
    return $this->db->query($query)->bind('id', $id)->fetch();
  }

  public function createSiswa($data)
  {
    $user  = "INSERT INTO pengguna VALUES(NULL, :username, :password, :role)";
    $this->db->query($user)
      ->binds([
        'username' => $data['nis'],
        'password' => md5($data['nis'] . SALT),
        'role' => 3
      ])
      ->execute();
    $id_pengguna = $this->db->lastInsertId();
    if ($this->db->rowCount() > 0) {
      $student  = "INSERT INTO {$this->table}
                   VALUES(NULL, :nisn, :nis, :nama, :alamat, :telepon, :id_kelas, :id_pengguna, :id_pembayaran)";
      return $this->db->query($student)
        ->binds([
          'nisn' => $data['nisn'],
          'nis' => $data['nis'],
          'nama' => $data['nama'],
          'alamat' => $data['alamat'],
          'telepon' => $data['telepon'],
          'id_kelas' => $data['id_kelas'],
          'id_pengguna' => $id_pengguna,
          'id_pembayaran' => $data['id_pembayaran']
        ])
        ->execute()
        ->rowCount();
    } else {
      return 0;
    }
  }

  public function updateSiswa($data)
  {
    $query = "UPDATE {$this->table}
              SET nisn=:nisn, nis=:nis, nama=:nama, alamat=:alamat,
              telepon=:telepon, id_kelas=:id_kelas, id_pembayaran=:id_pembayaran
              WHERE id_siswa=:id";
    return $this->db->query($query)
      ->binds([
        'nisn' => $data['nisn'],
        'nis' => $data['nis'],
        'nama' => $data['nama'],
        'alamat' => $data['alamat'],
        'telepon' => $data['telepon'],
        'id_kelas' => $data['id_kelas'],
        'id_pembayaran' => $data['id_pembayaran'],
        'id_siswa' => $data['id_siswa'],
      ])
      ->execute()
      ->rowCount();
  }

  public function updateNamaSiswa($data)
  {
    $query = "UPDATE {$this->table} SET nama = :nama WHERE id_siswa = :id";
    return $this->db->query($query)
      ->binds([
        'nama' => $data['nama'],
        'id' => $data['id_siswa'],
      ])
      ->execute()
      ->rowCount();
  }
}
