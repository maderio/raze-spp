<?php

class Siswa extends Controller
{

  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title' => 'Siswa',
      'siswa' => $this->model('siswa_model')->getAllSiswa(),
      'kelas' => $this->model('kelas_model')->getAllKelas(),
      'pembayaran' => $this->model('pembayaran_model')->getAllPembayaran(),
    ];
    $this->view('partials/header', $data);
    $this->view('siswa/index', $data);
    $this->view('partials/footer');
  }

  public function detail($id)
  {
    $data = [
      'title'   => 'Detail Siswa',
      'siswa' => $this->model('siswa_model')->getSiswaById($id),
    ];
    $this->view('partials/header', $data);
    $this->view('siswa/detail', $data);
    $this->view('partials/footer');
  }

  /**
   * CRUD Data to Database
   * method: GET, POST
   * role: admin (1)
   */

  public function create()
  {
    Gate::isAdmin();
    if (!empty($_POST)) {
      if ($this->model('siswa_model')->createSiswa($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil menambahkan data siswa.');
        $this->directTo('/siswa');
      } else {
        Flasher::setFlash('danger', 'Gagal menambahkan data siswa!');
        $this->directTo('/siswa');
      }
    }
  }

  public function update()
  {
    Gate::isAdmin();
    if (!empty($_POST)) {
      if ($this->model('student_model')->updateSiswa($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil merubah data siswa.');
        $this->directTo('/siswa');
      } else {
        Flasher::setFlash('danger', 'Gagal merubah data siswa!');
        $this->directTo('/siswa');
      }
    }
  }

  public function delete($id)
  {
    Gate::isAdmin();
    if ($this->model('auth_model')->deletePenggunaById($id) > 0) {
      Flasher::setFlash('success', 'Berhasil menghapus data siswa.');
      $this->directTo('/student');
    } else {
      Flasher::setFlash('danger', 'Gagal menghapus data siswa!');
      $this->directTo('/student');
    }
  }
}
