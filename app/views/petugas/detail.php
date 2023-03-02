<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">
        <a href="<?= BASE_URL ?>/petugas" class="btn btn-light btn-icon-split">
          <span class="icon text-gray-600">
            <i class="fas fa-arrow-left"></i>
          </span>
          <span class="text">Kembali</span>
        </a>
      </h6>
      <h5 class="m-0 font-weight-bold text-primary"><?= $data['petugas']['nama'] ?></h5>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Pengaturan Lainnya</div>
          <button onclick="copyToClipboard();" class="dropdown-item">Salin Tautan</button>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#hapusPetugas">Hapus</a>
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <form action="<?= BASE_URL ?>/petugas/update" method="post">
        <div class="form-row">
          <div class="col-md-5 d-flex justify-content-center align-item-center">
            <div class="col-8"><img src="<?= BASE_URL ?>/img/undraw_profile_<?= array_rand([1, 2, 3, 4]) ?>.svg" alt="<?= $data['petugas']['nama'] ?>" class="img-profile rounded-circle"></div>
          </div>

          <div class="col-md-7">
            <input type="hidden" name="id_petugas" value="<?= $data['petugas']['id_petugas'] ?>">

            <div class="form-group">
              <label for="labelNama">Nama</label>
              <input type="text" class="form-control" name="nama" id="labelNama" required maxlength="50" value="<?= $data['petugas']['nama'] ?>">
            </div>
            <div class="form-group">
              <label for="labelUsername">Username</label>
              <input type="text" class="form-control" name="username" id="labelUsername" required maxlength="25" value="<?= $data['petugas']['username'] ?>">
            </div>
            <div class="form-group">
              <label for="labelPassword">Password</label>
              <input type="password" class="form-control" name="password" id="labelPassword" required maxlength="50" value="<?= $data['petugas']['username'] ?>" disabled>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="hapusPetugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Apakah Yakin Menghapus Petugas '<?= $data['petugas']['nama'] ?>'?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="<?= BASE_URL ?>/petugas/delete/<?= $data['petugas']['id_pengguna'] ?>" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  function copyToClipboard() {
    var copyText = location.href;
    navigator.clipboard.writeText(copyText);
    alert("Tautan telah disalin ke clipboard!");
  }
</script>