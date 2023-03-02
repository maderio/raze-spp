<?php

class Transaksi extends Controller
{
  public function __construct()
  {
    Gate::isLoggedIn();
  }

  public function index()
  {
    $data = [
      'title' => 'Transaksi',
      'siswa' => $this->model('siswa_model')->getAllSiswa(),
    ];
    $this->view('partials/header', $data);
    $this->view('transaksi/index', $data);
    $this->view('partials/footer');
  }

  public function detail($id)
  {
    $siswa      = $this->model('siswa_model')->getSiswaById($id);
    $transaksi  = $this->model('transaksi_model')->getTransaksiByIdSiswa($siswa['id_siswa']);
    $bulan = [
      ['juli' => '07', 'agustus' => '08', 'september' => '09', 'oktober' => '10', 'november' => '11', 'desember' => '12'],
      ['januari' => '01', 'februari' => '02', 'maret' => '03', 'april' => '04', 'mei' => '05', 'juni' => '06'],
    ];
    $bulanDibayar = [];
    foreach ($transaksi as $key) {
      array_push($bulanDibayar, $key['bulan_dibayar']);
    }
    $data = [
      'title'         => 'Transaksi',
      'siswa'         => $siswa,
      'bulan'         => $bulan,
      'bulanDibayar'  => $bulanDibayar
    ];
    $this->view('partials/header', $data);
    $this->view('transaksi/detail', $data);
    $this->view('partials/footer');
  }

  public function create()
  {
    if (!empty($_POST)) {
      $data = [
        'id_siswa'      => $_POST['id_siswa'],
        'id_pembayaran' => $_POST['id_pembayaran'],
        'id_petugas'    => $_SESSION['user']['id_petugas'],
        'bulan_dibayar' => $_POST['bulan_dibayar'],
      ];
      if ($this->model('transaksi_model')->createTransaksi($data) > 0) {
        Flasher::setFlash('success', 'Berhasil melakukan transaksi!');
        $this->directTo("/transaksi/detail/{$data['id_siswa']}");
      } else {
        Flasher::setFlash('danger', 'Gagal melakukan transaksi!');
        $this->directTo("/transaksi/detail/{$data['id_siswa']}");
      }
    }
  }
}
