<?php

class Petugas extends Controller
{

  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title'   => 'Petugas',
      'petugas' => $this->model('petugas_model')->getAllPetugas(),
    ];
    $this->view('partials/header', $data);
    $this->view('petugas/index', $data);
    $this->view('partials/footer');
  }

  public function detail($id)
  {
    $data = [
      'title'   => 'Detail Petugas',
      'petugas' => $this->model('petugas_model')->getPetugasById($id),
    ];
    $this->view('partials/header', $data);
    $this->view('petugas/detail', $data);
    $this->view('partials/footer');
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($_POST['password'] == $_POST['confirm_password']) {
        if ($this->model('petugas_model')->createPetugas($_POST) > 0) {
          Flasher::setFlash('success', 'Berhasil menambahkan data petugas.');
          $this->directTo('/petugas');
        } else {
          Flasher::setFlash('danger', 'Gagal menambahkan data petugas!');
          $this->directTo('/petugas');
        }
      } else {
        Flasher::setFlash('danger', 'Password tidak sama!');
        $this->directTo('/petugas');
      }
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('petugas_model')->updatePetugas($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil merubah data petugas.');
        $this->directTo('/petugas');
      } else {
        Flasher::setFlash('danger', 'Gagal merubah data petugas!');
        $this->directTo('/petugas');
      }
    }
  }

  public function delete($id)
  {
    Gate::isAdmin();
    if ($this->model('auth_model')->deletePenggunaById($id) > 0) {
      Flasher::setFlash('success', 'Berhasil menghapus data petugas.');
      $this->directTo('/petugas');
    } else {
      Flasher::setFlash('danger', 'Gagal menghapus data petugas!');
      $this->directTo('/petugas');
    }
  }
}
