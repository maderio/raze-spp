<?php

class Kelas extends Controller
{

  public function __construct()
  {
    Middleware::isPetugas();
  }

  public function index()
  {
    $data = [
      'title' => 'Kelas',
      'kelas' => $this->model('kelas_model')->getAllKelas(),
    ];
    $this->view('partials/header', $data);
    $this->view('kelas/index', $data);
    $this->view('partials/footer');
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('kelas_model')->createKelas($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil menambahkan data kelas.');
        $this->redirect('/kelas');
      } else {
        Flasher::setFlash('danger', 'Gagal menambahkan data kelas!');
        $this->redirect('/kelas');
      }
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('kelas_model')->updateKelas($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil merubah data kelas.');
        $this->redirect('/kelas');
      } else {
        Flasher::setFlash('danger', 'Gagal merubah data kelas!');
        $this->redirect('/kelas');
      }
    }
  }

  public function delete($id)
  {
    if ($this->model('kelas_model')->deleteKelasById($id) > 0) {
      Flasher::setFlash('success', 'Berhasil menghapus data kelas.');
      $this->redirect('/kelas');
    } else {
      Flasher::setFlash('danger', 'Gagal menghapus data kelas!');
      $this->redirect('/kelas');
    }
  }
}
