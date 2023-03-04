<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">
        <a href="<?= BASE_URL ?>/siswa" class="btn btn-light btn-icon-split">
          <span class="icon text-gray-600">
            <i class="fas fa-arrow-left"></i>
          </span>
          <span class="text">Kembali</span>
        </a>
      </h6>
      <h5 class="m-0 font-weight-bold text-primary"><?= $data['siswa']['nama'] ?></h5>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Pengaturan Lainnya</div>
          <button onclick="copyToClipboard();" class="dropdown-item">Salin Tautan</button>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#hapusSiswa">Hapus</a>
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <form action="<?= BASE_URL ?>/siswa/update" method="post">
        <div class="form-row">
          <div class="col-md-5 d-flex justify-content-center align-item-center">
            <div class="col-8"><img src="<?= BASE_URL ?>/img/undraw_profile_<?= array_rand([1, 2, 3, 4]) ?>.svg" alt="<?= $data['siswa']['nama'] ?>" class="img-profile rounded-circle shadow-lg"></div>
          </div>

          <div class="col-md-7">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="hidden" name="id_siswa" value="<?= $data['siswa']['id_siswa'] ?>">
                <label for="labelNisn">NISN</label>
                <input type="text" class="form-control" name="nisn" id="labelNisn" required maxlength="10" value="<?= $data['siswa']['nisn'] ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="labelNis">NIS</label>
                <input type="text" class="form-control" name="nis" id="labelNis" required maxlength="5" value="<?= $data['siswa']['nis'] ?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelNama">Nama</label>
                <input type="text" class="form-control" name="nama" id="labelNama" required maxlength="50" value="<?= $data['siswa']['nama'] ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="labelTelepon">Telepon</label>
                <input type="text" class="form-control" name="telepon" id="labelTelepon" required maxlength="14" value="<?= $data['siswa']['telepon'] ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="labelAlamat">Alamat</label>
              <textarea name="alamat" class="form-control" id="labelAlamat" cols="30" rows="5" required><?= $data['siswa']['alamat'] ?></textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelKelas">Kelas</label>
                <select name="id_kelas" id="labelKelas" class="form-control" required>
                  <option value="<?= $data['siswa']['id_kelas'] ?>" selected><?= $data['siswa']['nama_kelas'] ?></option>
                  <?php foreach ($data['kelas'] as $key) :
                    if ($key['id_kelas'] != $data['siswa']['id_kelas']) : ?>
                      <option value="<?= $key['id_kelas'] ?>"><?= $key['nama'] ?></option>
                  <?php endif;
                  endforeach ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="labelSpp">SPP</label>
                <select name="id_pembayaran" id="labelSpp" class="form-control" required>
                  <option value="<?= $data['siswa']['id_pembayaran'] ?>" selected><?= $data['siswa']['tahun_ajaran'] ?></option>
                  <?php foreach ($data['pembayaran'] as $key) :
                    if ($key['id_pembayaran'] != $data['siswa']['id_pembayaran']) : ?>
                      <option value="<?= $key['id_pembayaran'] ?>"><?= $key['tahun_ajaran'] ?></option>
                  <?php endif;
                  endforeach ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="hapusSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Apakah Yakin Menghapus Siswa?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- <div class="modal-body"></div> -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="<?= BASE_URL ?>/siswa/delete/<?= $data['siswa']['id_pengguna'] ?>" class="btn btn-danger">Hapus</a>
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