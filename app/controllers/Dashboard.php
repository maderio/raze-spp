<?php

class Dashboard extends Controller
{
  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $this->view('partials/header', $data);
    if ($_SESSION['user']['role'] < 3) {
      $data['count'] = [
        'kelas'     => $this->model('kelas_model')->getCountKelas(),
        'siswa'     => $this->model('siswa_model')->getCountSiswa(),
        'petugas'   => $this->model('petugas_model')->getCountPetugas(),
        'transaksi' => $this->model('transaksi_model')->getCountTransaksi(),
      ];
      $this->view('dashboard/index', $data);
    } elseif ($_SESSION['user']['role'] == 3) {
      $siswa = $this->model('siswa_model')->getSiswaById($_SESSION['user']['id_siswa']);
      $total_transaksi = $this->model('transaksi_model')->getTotalTansaksiByIdSiswa($_SESSION['user']['id_siswa']);
      $data['siswa'] = [
        'total_transaksi' => $total_transaksi['total_transaksi'],
        'spp_kurang'  => (12 - $total_transaksi['total_transaksi']) * $siswa['nominal'],
      ];
      $this->view('dashboard/siswa', $data);
    }
    $this->view('partials/footer');
  }
}
