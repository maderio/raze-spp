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
    $this->db->query($query);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllSiswa()
  {
    $query  = "SELECT siswa.*, pengguna.*, pembayaran.*, kelas.nama as nama_kelas, kelas.kompetensi_keahlian
               FROM {$this->table}
               LEFT JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
               LEFT JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
               LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
    $this->db->query($query);
    return $this->db->fetchAll();
  }

  public function getSiswaById($id)
  {
    $query  = "SELECT siswa.*, pengguna.*, pembayaran.*, kelas.nama as nama_kelas, kelas.kompetensi_keahlian
               FROM {$this->table}
               LEFT JOIN pengguna ON siswa.id_pengguna = pengguna.id_pengguna
               LEFT JOIN pembayaran ON siswa.id_pembayaran = pembayaran.id_pembayaran
               LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
               WHERE siswa.id_siswa = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->fetch();
  }

  public function createSiswa($data)
  {
    $user  = "INSERT INTO pengguna VALUES(NULL, :username, :password, :role)";
    $this->db->query($user);
    $this->db->bind('username', $data['nis']);
    $this->db->bind('password', md5($data['nis'] . SALT));
    $this->db->bind('role', 3);
    $this->db->execute();
    $id_pengguna = $this->db->lastInsertId();
    if ($this->db->rowCount() > 0) {
      $student  = "INSERT INTO {$this->table}
                   VALUES(NULL, :nisn, :nis, :nama, :alamat, :telepon, :id_kelas, :id_pengguna, :id_pembayaran)";
      $this->db->query($student);
      $this->db->bind('nisn', $data['nisn']);
      $this->db->bind('nis', $data['nis']);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('alamat', $data['alamat']);
      $this->db->bind('telepon', $data['telepon']);
      $this->db->bind('id_kelas', $data['id_kelas']);
      $this->db->bind('id_pengguna', $id_pengguna);
      $this->db->bind('id_pembayaran', $data['id_pembayaran']);
      $this->db->execute();
      return $this->db->rowCount();
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
    $this->db->query($query);
    $this->db->bind('nisn', $data['nisn']);
    $this->db->bind('nis', $data['nis']);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('alamat', $data['alamat']);
    $this->db->bind('telepon', $data['telepon']);
    $this->db->bind('id_kelas', $data['id_kelas']);
    $this->db->bind('id_pembayaran', $data['id_pembayaran']);
    $this->db->bind('id_siswa', $data['id_siswa']);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
