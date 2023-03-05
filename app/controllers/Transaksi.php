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
    $transaksi  = $this->model('transaksi_model')->getBulanDibayarByIdSiswa($siswa['id_siswa']);
    $bulan = [
      ['7' => 'juli', '8' => 'agustus', '9' => 'september', '10' => 'oktober', '11' => 'november', '12' => 'desember'],
      ['1' => 'januari', '2' => 'februari', '3' => 'maret', '4' => 'april', '5' => 'mei', '6' => 'juni'],
    ];
    $bulanDibayar = [];
    foreach ($transaksi as $key) {
      array_push($bulanDibayar, $key);
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

  public function riwayat()
  {
    $siswa = $this->model('siswa_model')->getAllSiswa();
    $bulan = [
      ['7' => 'juli', '8' => 'agustus', '9' => 'september', '10' => 'oktober', '11' => 'november', '12' => 'desember'],
      ['1' => 'januari', '2' => 'februari', '3' => 'maret', '4' => 'april', '5' => 'mei', '6' => 'juni'],
    ];
    $bulanDibayar = [];
    foreach ($siswa as $key) {
      $bulanDibayar[$key['id_siswa']] = [];
      $transaksi = $this->model('transaksi_model')->getBulanDibayarByIdSiswa($key['id_siswa']);
      foreach ($transaksi as $trx) {
        array_push($bulanDibayar[$key['id_siswa']], $trx);
      }
    }
    $data = [
      'title'         => 'Riwayat Transaksi',
      'bulan'         => $bulan,
      'siswa'         => $siswa,
      'bulanDibayar'  => $bulanDibayar,
    ];
    $this->view('partials/header', $data);
    $this->view('transaksi/riwayat', $data);
    $this->view('partials/footer');
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = [
        'id_siswa'      => $_POST['id_siswa'],
        'id_pembayaran' => $_POST['id_pembayaran'],
        'id_petugas'    => $_SESSION['user']['id_petugas'],
        'bulan_dibayar' => (isset($_POST['bulan_dibayar'])) ? $_POST['bulan_dibayar'] : false,
      ];
      if ($data['bulan_dibayar'] === false) {
        Flasher::setFlash('warning', '<strong>Gagal melakukan transaksi!</strong><br>Silahkan pilih bulan untuk melakukan transaksi.');
        $this->directTo("/transaksi/detail/{$data['id_siswa']}");
      }
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
