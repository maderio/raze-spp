<?php

class Pengguna extends Controller
{
  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title' => 'Pengguna',
    ];
    $this->view('partials/header', $data);
    $this->view('pengguna/index', $data);
    $this->view('partials/footer');
  }

  public function riwayat_login()
  {
    $data = [
      'title' => 'Riwayat Login',
      'riwayat_login' => $this->model('pengguna_model')->getRiwayatLoginById($_SESSION['user']['id']),
    ];
    $this->view('partials/header', $data);
    $this->view('pengguna/riwayat_login', $data);
    $this->view('partials/footer');
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = [
        'id_pengguna' => $_SESSION['user']['id'],
        'nama'        => $_POST['nama'],
        'username'    => $_POST['username'],
        'role'        => $_SESSION['user']['role'],
      ];
      $pengguna = $this->model('pengguna_model')->getPenggunaById($_POST['id_pengguna']);
      $password = md5($_POST['password']['old'] . SALT);
      if ($password == $pengguna['password']) {
        if (!empty($_POST['password']['new'])) {
          if ($_POST['password']['new'] == $_POST['password']['confirm']) {
            $data['password'] = md5($_POST['password']['new'] . SALT);
          } else {
            Flasher::setFlash('danger', 'Konfirmasi kata sandi salah!');
            $this->directTo('/pengguna');
          }
        } else {
          $data['password'] = $password;
        }
        if ($data['role'] < 3) {
          $data['id_petugas'] = $_SESSION['user']['id_petugas'];
          $update_nama = $this->model('petugas_model')->updatePetugas($data);
        } else {
          $data['id_siswa'] = $_SESSION['user']['id_siswa'];
          $update_nama = $this->model('siswa_model')->updateNamaSiswa($data);
        }
        $update_pengguna = $this->model('pengguna_model')->updatePengguna($data);
        $updates = $update_nama + $update_pengguna;
        if ($updates > 0) {
          $this->model('auth_model')->setUserSession($data);
          Flasher::setFlash('success', 'Profile diperbarui!');
          $this->directTo('/pengguna');
        } else {
          Flasher::setFlash('danger', 'Gagal memperbarui profile!');
          $this->directTo('/pengguna');
        }
        echo $updates;
      } else {
        Flasher::setFlash('danger', 'Kata Sandi yang Anda masukan salah!');
        $this->directTo('/pengguna');
      }
    }
  }
}
