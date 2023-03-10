<?php

class Dashboard extends Controller
{
  public function __construct()
  {
    Middleware::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title' => 'Dashboard',
      'count' => [
        'kelas'     => $this->model('kelas_model')->getCountKelas(),
        'siswa'     => $this->model('siswa_model')->getCountSiswa(),
        'petugas'   => $this->model('petugas_model')->getCountPetugas(),
        'transaksi' => $this->model('transaksi_model')->getCountTransaksi(),
      ]
    ];
    $this->view('partials/header', $data);
    $this->view('dashboard/index', $data);
    $this->view('partials/footer');
  }

  public function siswa()
  {
    Middleware::isSiswa();
    $siswa = $this->model('siswa_model')->getSiswaById($_SESSION['user']['id_siswa']);
    $total_transaksi = $this->model('transaksi_model')->getTotalTransaksiByIdSiswa($_SESSION['user']['id_siswa'])['total_transaksi'];
    $data = [
      'title' => 'Dashboard',
      'siswa' => [
        'total_transaksi' => $total_transaksi,
        'spp_kurang' => (12 - $total_transaksi) * $siswa['nominal']
      ]
    ];
    $this->view('partials/header', $data);
    $this->view('dashboard/siswa', $data);
    $this->view('partials/footer');
  }
}
