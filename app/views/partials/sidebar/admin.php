<!-- Heading -->
<div class="sidebar-heading">
  Transaksi
</div>

<!-- Nav Item - Pembayaran -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTransaksi">
    <i class="fas fa-fw fa-dollar-sign"></i>
    <span>Transaksi</span>
  </a>
  <div id="collapseTransaksi" class="collapse" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Transaksi:</h6>
      <a class="collapse-item" href="<?= BASE_URL ?>/transaksi">Bayar</a>
      <a class="collapse-item" href="<?= BASE_URL ?>/transaksi/riwayat">Riwayat</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Manajemen
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkun" aria-expanded="true" aria-controls="collapseAkun">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Akun</span>
  </a>
  <div id="collapseAkun" class="collapse" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Akun:</h6>
      <a class="collapse-item" href="<?= BASE_URL ?>/petugas">Petugas</a>
      <a class="collapse-item" href="<?= BASE_URL ?>/siswa">Siswa</a>
    </div>
  </div>
</li>

<!-- Nav Item - Kelas -->
<li class="nav-item">
  <a class="nav-link" href="<?= BASE_URL ?>/kelas">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Kelas</span></a>
</li>

<!-- Nav Item - Pembayaran -->
<li class="nav-item">
  <a class="nav-link" href="<?= BASE_URL ?>/pembayaran">
    <i class="fas fa-fw fa-table"></i>
    <span>Pembayaran</span></a>
</li>