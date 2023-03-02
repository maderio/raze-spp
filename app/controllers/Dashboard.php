<?php

class Dashboard extends Controller
{

  public function __construct()
  {
    Gate::isLoggedIn();
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
}
