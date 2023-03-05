<?php

class Pembayaran extends Controller
{

  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title'       => 'Pembayaran',
      'pembayaran'  => $this->model('pembayaran_model')->getAllPembayaran(),
    ];
    $this->view('partials/header', $data);
    $this->view('pembayaran/index', $data);
    $this->view('partials/footer');
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('pembayaran_model')->createPembayaran($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil menambahkan data pembayaran.');
        $this->directTo('/pembayaran');
      } else {
        Flasher::setFlash('danger', 'Gagal menambahkan data pembayaran!');
        $this->directTo('/pembayaran');
      }
    }
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('pembayaran_model')->updatePembayaran($_POST) > 0) {
        Flasher::setFlash('success', 'Berhasil merubah data pembayaran.');
        $this->directTo('/pembayaran');
      } else {
        Flasher::setFlash('danger', 'Gagal merubah data pembayaran!');
        $this->directTo('/pembayaran');
      }
    }
  }

  public function delete($id)
  {
    if ($this->model('pembayaran_model')->deletePembayaranById($id) > 0) {
      Flasher::setFlash('success', 'Berhasil menghapus data pembayaran.');
      $this->directTo('/pembayaran');
    } else {
      Flasher::setFlash('danger', 'Gagal menghapus data pembayaran!');
      $this->directTo('/pembayaran');
    }
  }
}
